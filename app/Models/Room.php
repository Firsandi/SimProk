<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'period',
        'organization_type',
        'admin_id',
        'status',
        'color',
        'room_type',
    ];

    /**
     * Relasi ke Document
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function getDocumentStats(): array
    {
        $approved = $this->documents()
            ->whereHas('latestStatus', function ($query) {
                $query->where('status', 'approved');
            })
            ->count();

        $pending = $this->documents()
            ->whereHas('latestStatus', function ($query) {
                $query->where('status', 'pending');
            })
            ->count();

        $rejected = $this->documents()
            ->whereHas('latestStatus', function ($query) {
                $query->whereIn('status', ['rejected', 'revision']);
            })
            ->count();

        return [
            'approved' => $approved,
            'pending'  => $pending,
            'rejected' => $rejected,
            'total'    => $approved + $pending + $rejected,
        ];
    }
    
    public function getRecentNotificationCount(): int
    {
        return $this->documents()
            ->where('created_at', '>=', now()->subDay())
            ->count();
    }
}
