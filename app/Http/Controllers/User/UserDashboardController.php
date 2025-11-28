<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentStatus;
use App\Models\Notification;

class UserDashboardController extends Controller
{
    /**
     * Dashboard utama user
     */
    public function index()
    {
        $user = auth()->user();

        // Statistik milik user
        $totalProkers = $user->ownedProkers()->count(); // jumlah proker milik user
        $totalDocs    = $user->documents()->count();    // jumlah dokumen yang diunggah user
        $pending      = DocumentStatus::where('status', 'pending')
                                      ->where('reviewed_by', $user->id)
                                      ->count();        // jumlah dokumen pending yang direview user

        // Preview data untuk dashboard
        $myProkers = $user->ownedProkers()
                          ->with('documents')
                          ->latest()
                          ->take(3)
                          ->get();

        $recentDocs = $user->documents()
                           ->latest()
                           ->take(5)
                           ->get();

        $notifications = $user->notifications()
                              ->latest()
                              ->take(5)
                              ->get();

        return view('user.Dashboard', compact(
            'totalProkers',
            'totalDocs',
            'pending',
            'myProkers',
            'recentDocs',
            'notifications'
        ));
    }

    /**
     * Halaman My Prokers (semua proker milik user)
     */
    public function myProkers()
    {
        $user = auth()->user();

        $myProkers = $user->ownedProkers()
                          ->with(['documents', 'room']) // kalau butuh info organisasi
                          ->latest()
                          ->get();

        return view('user.MyProkers', compact('myProkers'));
    }
}
