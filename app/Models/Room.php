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
        return [
            'approved' => $this->documents()
                ->whereHas('latestStatus', fn($q) => $q->where('status', 'approved'))
                ->count(),
            'pending'  => $this->documents()
                ->whereHas('latestStatus', fn($q) => $q->where('status', 'pending'))
                ->count(),
            'rejected' => $this->documents()
                ->whereHas('latestStatus', fn($q) => $q->whereIn('status', ['rejected', 'revision']))
                ->count(),
        ];
    }

    public function getRecentNotificationCount(): int
    {
        return $this->documents()
            ->whereHas('latestStatus', fn($q) => $q->where('status', 'pending'))
            ->count();
    }
}
