<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RoomProker;
use App\Models\RoomMember;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Statistik dashboard
        $totalRooms   = $user->joinedRooms()->count();
        $totalDocs    = Document::where('submitted_by', $user->id)->count();
        $pendingDocs  = Document::where('submitted_by', $user->id)
            ->whereDoesntHave('statuses', function ($q) {
                $q->whereIn('status', ['approved', 'rejected']);
            })
            ->count();

        $myProkers = RoomProker::whereHas('members', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })
            ->with(['room', 'documents'])
            ->latest()
            ->take(3)
            ->get();

        // Dokumen terbaru (5 dokumen)
        $recentDocs = Document::where('submitted_by', $user->id)
            ->with(['latestStatus', 'room'])
            ->latest()
            ->take(5)
            ->get();

        return view('user.Dashboard', compact(
            'totalRooms',
            'totalDocs',
            'pendingDocs',
            'myProkers',
            'recentDocs'
        ));
    }

    public function myProkers()
    {
        $user = Auth::user();

        $myProkers = RoomProker::whereHas('members', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->with(['room', 'documents'])
            ->latest()
            ->get()
            ->map(function ($proker) use ($user) {

                // Ambil role user dari room_members (role di level room)
                $member = RoomMember::where('room_id', $proker->room_id)
                    ->where('user_id', $user->id)
                    ->first();

                $proker->user_role = $member ? $member->role : 'Anggota';

                // Hitung progress berdasarkan jumlah dokumen
                $proker->progress = $proker->documents->count() > 0
                    ? min(($proker->documents->count() * 25), 100)
                    : 0;

                return $proker;
            });

        return view('user.MyProkers', compact('myProkers'));
    }
}
