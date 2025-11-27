<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proker extends Model
{
    protected $table = 'room_proker';
    protected $guarded = [];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'proker_members', 'proker_id', 'user_id')->withTimestamps();
    }
}
