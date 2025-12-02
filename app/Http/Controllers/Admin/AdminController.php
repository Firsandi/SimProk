<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Document;
use App\Models\DocumentStatus;

class AdminController extends Controller
{
    // public function index()
    // {
    //     // Statistik umum
    //     $totalRooms = Room::where('status', 'active')->count();
    //     $approved   = DocumentStatus::where('status', 'approved')->count();
    //     $pending    = DocumentStatus::where('status', 'pending')->count();
    //     $rejected   = DocumentStatus::whereIn('status', ['rejected', 'revision'])->count();

    //     $stats = [
    //         'total_ukm' => $totalRooms,
    //         'approved'  => $approved,
    //         'pending'   => $pending,
    //         'rejected'  => $rejected,
    //     ];

    //     // Periode
    //     $periods = Room::distinct()
    //                    ->pluck('period')
    //                    ->sort()
    //                    ->reverse()
    //                    ->toArray();

    //     // Rooms dengan statistik
    //     $rooms = Room::with(['documents.latestStatus'])
    //                  ->where('status', 'active')
    //                  ->latest()
    //                  ->get()
    //                  ->map(function ($room) {
    //                      $s    = $room->getDocumentStats();
    //                      $notif = $room->getRecentNotificationCount();

    //                      return [
    //                          'id'       => $room->id,
    //                          'name'     => $room->name,
    //                          'period'   => $room->period,
    //                          'status'   => $room->status,
    //                          'color'    => $room->color ?? 'blue',
    //                          'approved' => $s['approved'],
    //                          'pending'  => $s['pending'],
    //                          'rejected' => $s['rejected'],
    //                          'notification'     => $notif > 0 ? "$notif Dokumen baru" : "Tidak ada perubahan",
    //                          'has_notification' => $notif > 0,
    //                      ];
    //                  });

    //     return view('admin.dashboard', compact('stats','rooms','periods'));
    // }

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
                     return [
                         'id'       => $room->id,
                         'name'     => $room->name,
                         'period'   => $room->period,
                         'status'   => $room->status,
                         'approved' => $s['approved'],
                         'pending'  => $s['pending'],
                         'rejected' => $s['rejected'],
                         'has_notification' => $room->getRecentNotificationCount() > 0,
                         'notification'     => $room->getRecentNotificationCount() > 0
                                               ? $room->getRecentNotificationCount().' Dokumen baru'
                                               : 'Tidak ada perubahan',
                     ];
                 });

    return view('admin.dashboard', compact('stats','rooms'));
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
