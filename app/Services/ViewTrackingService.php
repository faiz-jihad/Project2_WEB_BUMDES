<?php

namespace App\Services;

use App\Models\ViewLog;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ViewTrackingService
{
    /**
     * Track a view for an entity
     */
    public function trackView(Model $entity, ?int $userId = null): bool
    {
        $fingerprint = $this->generateFingerprint();

        // Record the view in view_logs table
        $recorded = ViewLog::recordView($entity, $userId, $fingerprint);

        if ($recorded) {
            // Also track as an event
            Event::track('view', $entity, $userId, [
                'entity_type' => get_class($entity),
                'entity_id' => $entity->getKey(),
                'fingerprint' => $fingerprint,
            ]);
        }

        return $recorded;
    }

    /**
     * Get view count for an entity
     */
    public function getViewCount(Model $entity): int
    {
        return $entity->views_count ?? 0;
    }

    /**
     * Get popular entities by views
     */
    public function getPopularEntities(string $entityType, int $limit = 10, int $days = 30)
    {
        $startDate = now()->subDays($days);

        return ViewLog::selectRaw('entity_id, COUNT(*) as view_count')
            ->where('entity_type', $entityType)
            ->where('viewed_at', '>=', $startDate)
            ->groupBy('entity_id')
            ->orderBy('view_count', 'desc')
            ->limit($limit)
            ->with(['entity' => function ($query) {
                $query->select('id', 'title', 'slug'); // Adjust fields as needed
            }])
            ->get();
    }

    /**
     * Get view statistics
     */
    public function getViewStats(int $days = 30): array
    {
        $startDate = now()->subDays($days);

        $stats = ViewLog::selectRaw('entity_type, COUNT(*) as count, DATE(viewed_at) as date')
            ->where('viewed_at', '>=', $startDate)
            ->groupBy('entity_type', 'date')
            ->orderBy('date')
            ->get()
            ->groupBy('entity_type');

        $result = [];
        foreach ($stats as $entityType => $data) {
            $result[$entityType] = $data->pluck('count', 'date')->toArray();
        }

        return $result;
    }

    /**
     * Check if user has viewed entity recently
     */
    public function hasViewedRecently(Model $entity, ?int $userId = null, int $minutes = 5): bool
    {
        $fingerprint = $this->generateFingerprint();

        return ViewLog::where('entity_type', get_class($entity))
            ->where('entity_id', $entity->getKey())
            ->where('fingerprint', $fingerprint)
            ->where('viewed_at', '>=', now()->subMinutes($minutes))
            ->exists();
    }

    /**
     * Generate a unique fingerprint for view tracking
     */
    private function generateFingerprint(): string
    {
        return ViewLog::generateFingerprint();
    }

    /**
     * Clean up old view logs (for maintenance)
     */
    public function cleanupOldLogs(int $daysToKeep = 90): int
    {
        return ViewLog::where('viewed_at', '<', now()->subDays($daysToKeep))
            ->delete();
    }

    /**
     * Get real-time view count (cached)
     */
    public function getCachedViewCount(Model $entity, int $cacheMinutes = 5): int
    {
        $cacheKey = "view_count_{$entity->getTable()}_{$entity->getKey()}";

        return Cache::remember($cacheKey, now()->addMinutes($cacheMinutes), function () use ($entity) {
            return $this->getViewCount($entity);
        });
    }

    /**
     * Increment view count on entity
     */
    public function incrementViewCount(Model $entity): void
    {
        if (method_exists($entity, 'increment')) {
            $entity->increment('views_count');
        }
    }
}
