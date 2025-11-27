<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RoomMemberController extends Controller
{
    public function index(Request $request,Room $room)
    {
        $members = $room->members()->orderBy('name')->get();
        return view('admin.room.member.index', compact('room','members'));
    }

    public function create(Room $room)
    {
        $roles = ['bendahara', 'sekretaris'];
        return view('admin.room.member.create', compact('room','roles'));
    }

    public function store(Request $request, Room $room )
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:50|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'role' => 'required|string',
    ]);

    // buat user baru
    $user = User::create([
        'name'     => $request->name,
        'username' => $request->username,
        'email'    => $request->email,
        'password' => Hash::make('password'), // default password, bisa diganti
        'role'     => 'user',             // default role
        'is_active'=> true,  
    ]);

    // attach ke room dengan role
    $room->members()->attach($user->id, ['role' => $request->role,
    ]);

    return redirect()->route('admin.room.member.index', $room->id)->with('success', 'Anggota berhasil ditambahkan.');
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

