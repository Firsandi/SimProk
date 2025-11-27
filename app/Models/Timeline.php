<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timeline extends Model
{
    protected $fillable = [
        'room_id',
        'activity_type', // document_uploaded, document_approved, document_revision, room_created, member_added
        'title',
        'description',
        'actor_id',
        'document_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function getActivityIcon(): string
    {
        return match($this->activity_type) {
            'document_approved' => 'check',
            'document_uploaded' => 'upload',
            'document_revision' => 'times',
            'room_created' => 'plus',
            'member_added' => 'user-plus',
            default => 'circle',
        };
    }

    public function getActivityColor(): string
    {
        return match($this->activity_type) {
            'document_approved' => 'green',
            'document_uploaded' => 'blue',
            'document_revision' => 'red',
            'room_created' => 'purple',
            'member_added' => 'orange',
            default => 'gray',
        };
    }
}
