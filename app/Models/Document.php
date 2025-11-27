<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function proker(): BelongsTo
    {
        return $this->belongsTo(Proker::class, 'proker_id');
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(DocumentStatus::class);
    }

    public function latestStatus()
    {
        return $this->hasOne(DocumentStatus::class)->latest('created_at');
    }
    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

}
