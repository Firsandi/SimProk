<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
use App\Models\Proker;
use App\Models\RoomMember;
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

    /**
     * Relasi ke dokumen
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Relasi ke proker
     */
    public function prokers()
    {
        return $this->hasMany(Proker::class, 'room_id');
    }

    /**
     * Statistik dokumen berdasarkan status
     */
    public function getDocumentStats(): array
    {
        return [
            'approved' => $this->documents()->whereHas('latestStatus', fn($q) => $q->where('status', 'approved'))->count(),
            'pending'  => $this->documents()->whereHas('latestStatus', fn($q) => $q->where('status', 'pending'))->count(),
            'rejected' => $this->documents()->whereHas('latestStatus', fn($q) => $q->whereIn('status', ['rejected', 'revision']))->count(),
        ];
    }

    /**
     * Hitung notifikasi terbaru (dokumen pending)
     */
    public function getRecentNotificationCount(): int
    {
        return $this->documents()
            ->whereHas('latestStatus', fn($q) => $q->where('status', 'pending'))
            ->count();
    }
        public function members()
    {
        return $this->hasMany(RoomMember::class);
    }
    

        public function joinedRooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'room_members', 'user_id', 'room_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }

}
