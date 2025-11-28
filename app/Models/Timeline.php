<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    */

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
        'password'          => 'hashed',
        'is_active'         => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

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

    // Relasi ke RoomMember (user sebagai member di room)
    public function roomMemberships(): HasMany
    {
        return $this->hasMany(RoomMember::class, 'user_id');
    }

    // Rooms yang diikuti user (many-to-many via room_members)
    public function joinedRooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'room_members', 'user_id', 'room_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    // Notifikasi milik user (kalau kamu punya tabel notifications custom)
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    // Timeline aktivitas user
    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class, 'actor_id');
    }

    // Proker yang dibuat user (relasi ke RoomProker)
    public function roomProkers(): HasMany
    {
        return $this->hasMany(RoomProker::class, 'user_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers / Business Logic
    |--------------------------------------------------------------------------
    */

    public function isAdmin(): bool
    {
        return in_array($this->role, [
            'admin',
            'wakil_kemahasiswaan_akademik_alumni',
            'kepala_bagian',
            'bpp',
        ]);
    }

    public function isRegularUser(): bool
    {
        return ! $this->isAdmin();
    }

    public function canUploadDocument(): bool
    {
        return in_array($this->role, ['sekretaris', 'bendahara']);
    }

    public function getInitial(): string
    {
        return strtoupper(substr($this->name, 0, 1));
    }

    public function getUnreadNotificationsCount(): int
    {
        return $this->notifications()
                    ->whereNull('read_at')
                    ->count();
    }

    // Scope: hanya user aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
