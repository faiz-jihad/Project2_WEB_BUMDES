<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type',
        'entity_type',
        'entity_id',
        'user_id',
        'session_id',
        'ip_address',
        'user_agent',
        'metadata',
        'occurred_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'occurred_at' => 'datetime',
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
     * Scope for specific event types
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('event_type', $type);
    }

    /**
     * Scope for events within a date range
     */
    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('occurred_at', [$startDate, $endDate]);
    }

    /**
     * Scope for events by IP address
     */
    public function scopeByIp($query, $ip)
    {
        return $query->where('ip_address', $ip);
    }

    /**
     * Scope for events by session
     */
    public function scopeBySession($query, $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }

    /**
     * Get event statistics
     */
    public static function getStats($days = 30)
    {
        $startDate = now()->subDays($days);

        return static::selectRaw('event_type, COUNT(*) as count')
            ->where('occurred_at', '>=', $startDate)
            ->groupBy('event_type')
            ->orderBy('count', 'desc')
            ->get();
    }

    /**
     * Track an event
     */
    public static function track(
        string $eventType,
        ?Model $entity = null,
        ?int $userId = null,
        array $metadata = []
    ): static {
        $request = request();

        return static::create([
            'event_type' => $eventType,
            'entity_type' => $entity ? get_class($entity) : null,
            'entity_id' => $entity ? $entity->getKey() : null,
            'user_id' => $userId ?? auth()->id(),
            'session_id' => session()->getId(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'metadata' => array_merge((array) $metadata, [
                'url' => $request->fullUrl(),
                'referrer' => $request->header('referer'),
                'method' => $request->method(),
            ]),
            'occurred_at' => now(),
        ]);
    }

    protected static function booted()
{
    static::created(function ($event) {
        broadcast(new \App\Events\EventLogged($event));
    });
}

}
