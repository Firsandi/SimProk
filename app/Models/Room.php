<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Document;


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
        'room_type',
    ];

    public function getDocumentStatus()
    {
        return [
            'approved' => $approved,
            'pending'  => $pending,
            'rejected' => $rejected,
            'total'    => $approved + $pending + $rejected,
        ];
    }

    public function getDocumentStats(): array
    {
        return [
            'approved' => $this->documents()->whereHas('latestStatus', fn($q) => $q->where('status', 'approved'))->count(),
            'pending'  => $this->documents()->whereHas('latestStatus', fn($q) => $q->where('status', 'pending'))->count(),
            'rejected' => $this->documents()->whereHas('latestStatus', fn($q) => $q->whereIn('status', ['rejected', 'revision']))->count(),
        ];
    }

    public function getRecentNotificationCount(): int
    {
        return $this->documents()
            ->whereHas('latestStatus', fn($q) 
            => $q->where('status', 'pending'))
            ->count();
    }


    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function prokers()
    {
        return $this->hasMany(Proker::class, 'room_id');
    }

        public function members()
    {
        return $this->belongsToMany(User::class, 'room_members', 'room_id', 'user_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }

        public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_members', 'user_id', 'room_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }


}
