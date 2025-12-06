<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Room;
use App\Models\RoomProker;
use App\Models\RoomMember;
use App\Models\Document;
use App\Models\DocumentStatus;
use App\Models\Notification;
use App\Models\Timeline;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];



    // Dokumen yang diunggah user
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'submitted_by');
    }

    // Status dokumen yang direview user
    public function documentStatuses(): HasMany
    {
        return $this->hasMany(DocumentStatus::class, 'reviewed_by');
    }



    /**
     * Relasi ke RoomMember (user sebagai member di room)
     */
    public function roomMemberships(): HasMany
    {
        return $this->hasMany(RoomMember::class, 'user_id');
    }
        /**
     * Proker yang di-buat/di-miliki user
     */
    public function ownedProkers(): HasMany
    {
        return $this->hasMany(RoomProker::class, 'user_id');
    }



    // Timeline aktivitas user
    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class, 'actor_id');
    }

    public function joinedRooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'room_members', 'user_id', 'room_id')
                    ->withTimestamps();
    }

    // App/Models/User.php

    public function joinedProkers(): BelongsToMany
    {
        return $this->belongsToMany(RoomProker::class, 'room_proker_members', 'user_id', 'room_proker_id')
                    ->withTimestamps();
    }



    // Cek apakah user admin
    public function isAdmin(): bool
    {
        return in_array($this->role, [
            'admin',
            'wakil_kemahasiswaan_akademik_alumni',
            'kepala_bagian',
            'bpp'
        ]);
    }

    // Cek apakah user regular (bukan admin)
    public function isRegularUser(): bool
    {
        return !$this->isAdmin();
    }

    // Cek apakah user bisa upload dokumen
    public function canUploadDocument(): bool
    {
        return in_array($this->role, ['sekretaris', 'bendahara']);
    }

    // Ambil inisial nama user
    public function getInitial(): string
    {
        return strtoupper(substr($this->name, 0, 1));
    }

    // Hitung jumlah notifikasi belum dibaca
    public function getUnreadNotificationsCount(): int
    {
        return $this->notifications()
                    ->whereNull('read_at')
                    ->count();
    }

    // Scope untuk filter user aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
