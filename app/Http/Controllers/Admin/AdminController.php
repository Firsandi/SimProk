<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Document;

class AdminController extends Controller
{
    public function index()
    {
        // Hitung total room aktif
        $totalRooms = Room::where('status', 'active')->count();

        // Hitung status dokumen
        $approved = Document::whereHas('latestStatus', fn($q) => $q->where('status','approved'))->count();
        $pending  = Document::whereHas('latestStatus', fn($q) => $q->where('status','pending'))->count();
        $rejected = Document::whereHas('latestStatus', fn($q) => $q->whereIn('status',['rejected','revision']))->count();

        // Satukan ke array stats
        $stats = [
            'total_ukm' => $totalRooms,
            'approved'  => $approved,
            'pending'   => $pending,
            'rejected'  => $rejected,
        ];

        // Ambil data room untuk card bawah
        $rooms = Room::with(['documents.latestStatus'])
            ->where('status','active')
            ->latest()
            ->get()
            ->map(function($room){
                $s = $room->getDocumentStats(); // helper kamu
                $notifCount = $room->getRecentNotificationCount();

                return [
                    'id'       => $room->id,
                    'name'     => $room->name,
                    'period'   => $room->period,
                    'status'   => $room->status,
                    'approved' => $s['approved'],
                    'pending'  => $s['pending'],
                    'rejected' => $s['rejected'],
                    'has_notification' => $notifCount > 0,
                    'notification'     => $notifCount > 0
                        ? $notifCount.' Dokumen baru'
                        : 'Tidak ada perubahan',
                ];
            });

        return view('admin.dashboard', compact('stats','rooms'));
    }

    public function timeline()
    {
        return view('admin.timeline', ['timeline_items' => [], 'timelines' => []]);
    }

    public function documents()
    {
        return view('admin.documents');
    }
}
