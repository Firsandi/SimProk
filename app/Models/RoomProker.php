<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomProker extends Model
{
    use SoftDeletes;

    protected $table = 'room_prokers';

    protected $fillable = [
        'room_id',
        'user_id',
        'nama_proker',
        'deskripsi',
        'tahun',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'proker_id');
    }
}
