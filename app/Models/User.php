<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',   // tambahan
        'email',
        'password',
        'role',       // tambahan
        'is_active',  // tambahan
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

    // Relasi
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

    // Cek role admin
    public function isAdmin(): bool
    {
        return in_array($this->role, [
            'admin',
            'wakil_kemahasiswaan_akademik_alumni',
            'kepala_bagian',
            'bpp'
        ]);
    }
        public function prokers()
    {
        return $this->belongsToMany(Proker::class, 'proker_members', 'user_id', 'proker_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }
}
