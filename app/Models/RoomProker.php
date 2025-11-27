<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomProker extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'room_id',
        'name',
        'description',
        'year',
        'start_date',
        'end_date',
        'status',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'proker_id');
    }
}
