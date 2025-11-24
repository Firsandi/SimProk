<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('admin.room.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.room.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'period' => 'required|string',
            'status' => 'required|in:active,inactive',
            'organization_type' => 'required|string',
            'room_type' => 'nullable|string',
        ]);

        Room::create([
            ...$validated,
            'admin_id' => auth()->id(),
            // 'room_type' => $user->role,
        ]);

        return redirect()->route('admin.room.index')->with('success', 'UKM/Ormawa berhasil ditambahkan.');
    }

    public function edit(Room $room)
    {
        return view('admin.room.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'period' => 'required|string',
            'status' => 'required|in:active,inactive',
            'organization_type' => 'nullable|string',
            'color' => 'nullable|string',
            'room_type' => 'nullable|string',
        ]);

        $room->update($validated);

        return redirect()->route('admin.room.index')->with('success', 'UKM/Ormawa berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.room.index')->with('success', 'UKM/Ormawa berhasil dihapus.');
    }
}

