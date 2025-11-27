<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proker extends Model
{
    protected $table = 'room_prokers';

    protected $fillable = [
        'room_id', 'name', 'description', 'year',
        'start_date', 'end_date', 'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'proker_id');
    }
}
