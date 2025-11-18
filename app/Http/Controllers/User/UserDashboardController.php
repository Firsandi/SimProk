<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Dummy data untuk testing
        $userRooms = [
            [
                'id' => 1,
                'name' => 'HMIF (Himpunan Mahasiswa Informatika)',
                'role' => 'Sekretaris',
                'period' => '2024/2025',
                'admin' => 'Ahmad Rizki',
                'members' => 15,
                'color' => 'blue',
                'documents' => [
                    [
                        'title' => 'Proposal Workshop Web Dev',
                        'status' => 'Menunggu Review',
                        'deadline' => '30 Nov 2024'
                    ],
                ]
            ],
        ];

        $totalDocuments = 8;
        $pendingDocuments = 3;
        $upcomingDeadlines = 2;
        $recentDocuments = [];
        $upcomingDeadlinesList = [];

        return view('user.Dashboard', compact(
            'userRooms',
            'totalDocuments',
            'pendingDocuments',
            'upcomingDeadlines',
            'recentDocuments',
            'upcomingDeadlinesList'
        ));
    }
}
