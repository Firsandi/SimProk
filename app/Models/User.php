<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;  // TAMBAHAN

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

    // Relasi yang sudah ada - TIDAK DIUBAH
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'submitted_by');
    }

    public function documentStatuses(): HasMany
    {
        return $this->hasMany(DocumentStatus::class, 'reviewed_by');
    }

    public function prokers(): BelongsToMany
    {
        return $this->belongsToMany(Proker::class, 'proker_members', 'user_id', 'proker_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    // Cek role admin - TIDAK DIUBAH
    public function isAdmin(): bool
    {
        return in_array($this->role, [
            'admin',
            'wakil_kemahasiswaan_akademik_alumni',
            'kepala_bagian',
            'bpp'
        ]);
    }

    // ========== TAMBAHAN BARU DI BAWAH INI ==========

    /**
     * Relasi ke RoomMember (user sebagai member di room)
     */
    public function roomMemberships(): HasMany
    {
        return $this->hasMany(RoomMember::class, 'user_id');
    }

    /**
     * Relasi ke Notification
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    /**
     * Relasi ke Timeline (sebagai actor)
     */
    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class, 'actor_id');
    }

    /**
     * Cek apakah user adalah regular user (bukan admin)
     */
    public function isRegularUser(): bool
    {
        return !$this->isAdmin();
    }

    /**
     * Cek apakah user bisa upload dokumen
     */
    public function canUploadDocument(): bool
    {
        return in_array($this->role, ['sekretaris', 'bendahara']);
    }

    /**
     * Get user's initial untuk avatar
     */
    public function getInitial(): string
    {
        return strtoupper(substr($this->name, 0, 1));
    }

    /**
     * Get unread notifications count
     */
    public function getUnreadNotificationsCount(): int
    {
        return $this->notifications()
                    ->whereNull('read_at')
                    ->count();
    }

    /**
     * Scope: Active users only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
