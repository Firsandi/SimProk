<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomProker;
use App\Models\RoomMember;
use App\Models\Room;


class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::withCount(['prokers','documents'])->get();
        return view('user.Rooms', compact('rooms'));
    }

    public function show($id)
    {
        $room = Room::with(['prokers.documents','members'])->findOrFail($id);
        return view('user.Room-detail', compact('room'));
    }


    public function create($prokerId)
    {
        $user = auth()->user();
        $proker = RoomProker::findOrFail($prokerId);
        $role = RoomMember::where('room_id', $proker->room_id)
            ->where('user_id', $user->id)
            ->value('role');

        if (!$role) {
            return redirect()->route('user.Dashboard')->with('error', 'Anda bukan anggota proker ini.');
        }

        $allowedDocs = [];

        if ($role === 'bendahara') {
            $allowedDocs[] = 'layout_bpp';
            if ($proker->status === 'completed') {
                $allowedDocs[] = 'spj';
            }
        }

        if ($role === 'sekretaris') {
            $allowedDocs[] = 'proposal';
            if ($proker->status === 'completed') {
                $allowedDocs[] = 'lpj';
            }
        }

        return view('user.DocumentCreate', compact('proker', 'allowedDocs', 'role'));
    }
}
