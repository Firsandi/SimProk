<?php

namespace App\Services;

use App\Models\Timeline;

class TimelineService
{
    public function getTimelines(string $status = null, string $organization = null, int $perPage = 15)
    {
        $query = Timeline::with(['room', 'actor', 'document'])->orderBy('created_at', 'desc');

        if ($status) {
            $map = [
                'approved' => 'document_approved',
                'pending'  => 'document_uploaded',
                'revision' => 'document_revision',
                'rejected' => 'document_revision',
            ];
            $type = $map[$status] ?? null;
            if ($type) {
                $query->where('activity_type', $type);
            }
        }

        if ($organization) {
            $query->whereHas('room', fn($q) => $q->where('slug', $organization));
        }

        return $query->paginate($perPage);
    }

    public function formatTimelines($timelines): array
    {
        return $timelines->map(function ($item) {
            return [
                'id'           => $item->id,
                'type'         => $item->activity_type,
                'title'        => $item->title,
                'timestamp'    => $item->created_at->diffForHumans(),
                'description'  => $item->description,
                'status'       => $this->getStatusLabel($item->activity_type),
                'organization' => $item->room->name ?? 'Unknown',
                'icon'         => $item->getActivityIcon(),
                'color'        => $item->getActivityColor(),
            ];
        })->toArray();
    }

    private function getStatusLabel(string $type): string
    {
        return match($type) {
            'document_approved' => 'Disetujui',
            'document_uploaded' => 'Menunggu Review',
            'document_revision' => 'Revisi',
            'room_created'      => 'Room Created',
            'member_added'      => 'Member Added',
            default             => 'Unknown',
        };
    }

    public function createTimeline(array $data): Timeline
    {
        return Timeline::create($data);
    }
}
