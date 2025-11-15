<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    protected $fillable = [
        'room_id',
        'title',
        'document_type',
        'file_path',
        'submitted_by',
        'submitted_at',
        'notes',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(DocumentStatus::class);
    }

    public function latestStatus()
    {
        return $this->hasOne(DocumentStatus::class)->latest('created_at');
    }
}
