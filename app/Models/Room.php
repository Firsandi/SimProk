<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'period',
        'organization_type',
        'admin_id',
        'status',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'room_id');
    }

    public function prokers(): HasMany
    {
        return $this->hasMany(RoomProker::class, 'room_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'room_members', 'room_id', 'user_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function getDocumentStats(): array
    {
        $counts = $this->documents()
            ->whereHas('latestStatus')
            ->with('latestStatus')
            ->get()
            ->groupBy(fn($doc) => $doc->latestStatus->status ?? 'pending')
            ->map->count();

        return [
            'approved' => $counts['approved'] ?? 0,
            'pending'  => $counts['pending'] ?? 0,
            'rejected' => ($counts['rejected'] ?? 0) + ($counts['revision'] ?? 0),
        ];
    }

    public function getRecentNotificationCount(): int
    {
        return $this->getDocumentStats()['pending'];
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
