<?php

namespace App\Services;

use App\Models\Room;
use App\Models\DocumentStatus;

class DashboardService
{
    public function getStats(): array
    {
        $totalRooms = Room::where('status', 'active')->count();
        $approved   = DocumentStatus::where('status', 'approved')->count();
        $pending    = DocumentStatus::where('status', 'pending')->count();
        $rejected   = DocumentStatus::whereIn('status', ['rejected', 'revision'])->count();

        return [
            'total_ukm' => $totalRooms,
            'approved'  => $approved,
            'pending'   => $pending,
            'rejected'  => $rejected,
        ];
    }

    public function getRoomsWithStats(string $period = null): array
    {
        $query = Room::with(['documents.latestStatus'])
                     ->where('status', 'active')
                     ->orderBy('created_at', 'desc');

        if ($period) {
            $query->where('period', $period);
        }

        return $query->get()->map(function ($room) {
            $stats = $room->getDocumentStats();
            $notif = $room->getRecentNotificationCount();

            return [
                'id'              => $room->id,
                'name'            => $room->name,
                'period'          => $room->period,
                'status'          => $room->status,
                'color'           => $room->color ?? 'blue',
                'approved'        => $stats['approved'],
                'pending'         => $stats['pending'],
                'rejected'        => $stats['rejected'],
                'notification'    => $notif > 0 ? "$notif Dokumen baru" : 'Tidak ada perubahan',
                'has_notification'=> $notif > 0,
            ];
        })->toArray();
    }

    public function getPeriods(): array
    {
        return Room::distinct()->pluck('period')->sort()->reverse()->toArray();
    }
}
