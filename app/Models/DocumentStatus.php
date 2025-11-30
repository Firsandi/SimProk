<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentStatus extends Model
{
    protected $fillable = [
        'document_id',
        'status',
        'reviewed_by',
        'notes',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function getStatusColor(): string
    {
        return match($this->status) {
            'approved' => 'green',
            'pending' => 'yellow',
            'revision' => 'blue',
            'rejected' => 'red',
            default => 'gray',
        };
    }

    public function getStatusIcon(): string
    {
        return match($this->status) {
            'approved' => '✅',
            'pending' => '⏳',
            'revision' => '🔄',
            'rejected' => '❌',
            default => '❓',
        };
    }
}
