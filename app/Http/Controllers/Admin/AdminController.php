<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\DocumentStatus;

class AdminController extends Controller
{
    public function index()
    {
        // Statistik umum
        $totalRooms = Room::where('status', 'active')->count();
        $approved   = DocumentStatus::where('status', 'approved')->count();
        $pending    = DocumentStatus::where('status', 'pending')->count();
        $rejected   = DocumentStatus::whereIn('status', ['rejected', 'revision'])->count();

        $stats = [
            'total_ukm' => $totalRooms,
            'approved'  => $approved,
            'pending'   => $pending,
            'rejected'  => $rejected,
        ];

        // Periode
        $periods = Room::distinct()
                       ->pluck('period')
                       ->sort()
                       ->reverse()
                       ->toArray();

        // Rooms dengan statistik
        $rooms = Room::with(['documents.latestStatus'])
                     ->where('status', 'active')
                     ->latest()
                     ->get()
                     ->map(function ($room) {
                         $s    = $room->getDocumentStats();
                         $notif = $room->getRecentNotificationCount();

                         return [
                             'id'       => $room->id,
                             'name'     => $room->name,
                             'period'   => $room->period,
                             'status'   => $room->status,
                             'color'    => $room->color ?? 'blue',
                             'approved' => $s['approved'],
                             'pending'  => $s['pending'],
                             'rejected' => $s['rejected'],
                             'notification'     => $notif > 0 ? "$notif Dokumen baru" : "Tidak ada perubahan",
                             'has_notification' => $notif > 0,
                         ];
                     });

        return view('admin.dashboard', compact('stats','rooms','periods'));
    }

    public function timeline()
    {
        // sementara kosong atau isi manual nanti
        return view('admin.timeline', ['timeline_items' => [], 'timelines' => []]);
    }

    public function documents()
    {
        return view('admin.documents');
    }
}
