<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Notification extends Model
{
    protected $fillable = [
        'user_id','type','title','message','data','read_at','action_url'
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function markAsRead(): void
    {
        $this->update(['read_at' => now()]);
    }

    public function isUnread(): bool
    {
        return $this->read_at === null;
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function getIcon(): string
    {
        return match($this->type) {
            'document_approved' => 'check-circle',
            'document_revision' => 'exclamation-circle',
            'deadline_reminder' => 'calendar-times',
            'room_invite' => 'door-open',
            default => 'bell',
        };
    }

    public function getColor(): string
    {
        return match($this->type) {
            'document_approved' => 'green',
            'document_revision' => 'red',
            'deadline_reminder' => 'yellow',
            'room_invite' => 'blue',
            default => 'gray',
        };
    }
}
