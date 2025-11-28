<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Document extends Model
{
    protected $fillable = [
        'room_id',
        'proker_id',
        'title',
        'document_type',
        'file_path',
        'submitted_by',
        'submitted_at',
        'notes',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function proker(): BelongsTo
    {
        return $this->belongsTo(RoomProker::class, 'proker_id');
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(DocumentStatus::class);
    }

    public function latestStatus(): HasOne
    {
        return $this->hasOne(DocumentStatus::class)->latest('created_at');
    }

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }
}
