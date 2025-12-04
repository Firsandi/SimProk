<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomProker extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_proker',
        'tahun',
        'deskripsi',
        'user_id',
        'room_id',
    ];

    // ✅ Accessor agar view tetap pakai $proker->name
    public function getNameAttribute()
    {
        return $this->nama_proker;
    }

    public function getPeriodAttribute()
    {
        return $this->tahun;
    }

    public function getDescriptionAttribute()
    {
        return $this->deskripsi;
    }

    public function getStatusAttribute()
    {
        // Default status karena tidak ada field status di database
        return 'ongoing';
    }

    // Relations
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'proker_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'proker_members', 'proker_id', 'user_id');
    }

    public function prokers()
    {
        return $this->belongsToMany(RoomProker::class, 'proker_members', 'user_id', 'proker_id');
    }

}
