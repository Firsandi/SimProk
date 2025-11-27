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

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function getStatusColor(): string
    {
        return match($this->status) {
            'approved' => 'green',
            'pending' => 'yellow',
            'revision', 'rejected' => 'red',
            default => 'gray',
        };
    }
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

}
