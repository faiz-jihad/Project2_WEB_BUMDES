<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ViewLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_type',
        'entity_id',
        'user_id',
        'session_id',
        'ip_address',
        'user_agent',
        'fingerprint',
        'viewed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the entity (polymorphic relationship)
     */
    public function entity()
    {
        return $this->morphTo();
    }

    /**
     * Scope for specific entity types
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('entity_type', $type);
    }

    /**
     * Scope for views within a date range
     */
    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('viewed_at', [$startDate, $endDate]);
    }

    /**
     * Scope for views by IP address
     */
    public function scopeByIp($query, $ip)
    {
        return $query->where('ip_address', $ip);
    }

    /**
     * Scope for views by session
     */
    public function scopeBySession($query, $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }

    /**
     * Scope for views by fingerprint
     */
    public function scopeByFingerprint($query, $fingerprint)
    {
        return $query->where('fingerprint', $fingerprint);
    }

    /**
     * Get view statistics
     */
    public static function getStats($days = 30)
    {
        $startDate = now()->subDays($days);

        return static::selectRaw('entity_type, COUNT(*) as count')
            ->where('viewed_at', '>=', $startDate)
            ->groupBy('entity_type')
            ->orderBy('count', 'desc')
            ->get();
    }

    /**
     * Record a view for an entity
     */
    public static function recordView(
        Model $entity,
        ?int $userId = null,
        ?string $fingerprint = null
    ): bool {
        $request = request();
        $now = now();

        // Check if this view should be counted (prevent spam)
        $existingView = static::where('entity_type', get_class($entity))
            ->where('entity_id', $entity->getKey())
            ->where('fingerprint', $fingerprint)
            ->where('viewed_at', '>=', $now->copy()->subMinutes(5)) // 5 minute cooldown
            ->exists();

        if ($existingView) {
            return false; // View already recorded recently
        }

        // Record the view
        static::create([
            'entity_type' => get_class($entity),
            'entity_id' => $entity->getKey(),
            'user_id' => $userId ?? auth()->id(),
            'session_id' => session()->getId(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'fingerprint' => $fingerprint,
            'viewed_at' => $now,
        ]);

        // Increment the views count on the entity
        if (method_exists($entity, 'incrementViews')) {
            $entity->incrementViews();
        }

        return true;
    }

    /**
     * Generate a fingerprint for view tracking
     */
    public static function generateFingerprint(): string
    {
        $request = request();
        $components = [
            $request->ip(),
            $request->userAgent(),
            session()->getId(),
        ];

        return hash('sha256', implode('|', $components));
    }
}
