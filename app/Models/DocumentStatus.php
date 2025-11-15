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
}
