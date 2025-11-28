<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoomMemberController extends Controller
{
    public function index(Request $request, Room $room)
    {
        $members = $room->members()->orderBy('name')->get();
        return view('admin.room.member.index', compact('room','members'));
    }

    public function create(Room $room)
    {
        $roles = ['bendahara', 'sekretaris'];
        return view('admin.room.member.create', compact('room','roles'));
    }

    public function store(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'username'              => 'required|string|max:50|unique:users,username',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:6|confirmed',
            'role'                  => 'required|in:bendahara,sekretaris',
        ]);

        $user = User::create([
            'name'      => $validated['name'],
            'username'  => (string) $validated['username'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'role'      => $validated['role'],
            'is_active' => true,  
        ]);

        $room->members()->attach($user->id, ['role' => $validated['role']]);

        return redirect()
            ->route('admin.room.member.index', $room->id)
            ->with('success', 'Anggota berhasil ditambahkan ke room.');
    }

    public function edit(Room $room)
    {
        //
    }

    public function update(Request $request, Room $room)
    {
        //
    }

    public function destroy(Room $room)
    {
        //
    }
}
