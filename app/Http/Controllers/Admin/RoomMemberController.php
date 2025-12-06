<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Notifications\WelcomeNewMemberNotification;

class RoomMemberController extends Controller
{
    /**
     * Display a listing of room members.
     */
    public function index(Request $request, Room $room)
    {
        $members = $room->members()
            ->withPivot('role')
            ->orderBy('name')
            ->get();
        
        return view('admin.room.member.index', compact('room', 'members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create(Room $room)
    {
        return view('admin.room.member.create', compact('room'));
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:bendahara,sekretaris',
        ]);

        // Buat user baru
        $user = User::create([
            'name'      => $validated['name'],
            'username'  => (string) $validated['username'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'role'      => $validated['role'],
            'is_active' => true,  
        ]);

        // Attach ke room
        $room->members()->attach($user->id, [
            'role' => $validated['role'],
        ]);

        // Kirim notifikasi welcome
        $user->notify(new WelcomeNewMemberNotification($room));
        
        return redirect()
            ->route('admin.room.member.index', $room->id)
            ->with('success', 'Anggota "' . $user->name . '" berhasil ditambahkan sebagai ' . ucfirst($validated['role']) . ' di ' . $room->name . ' dan notifikasi welcome telah dikirim!');
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit(Room $room, User $member)
    {
        $memberPivot = $room->members()->where('users.id', $member->id)->first();
        
        if (!$memberPivot) {
            return redirect()
                ->route('admin.room.member.index', $room->id)
                ->with('error', 'Anggota tidak ditemukan di organisasi ini.');
        }

        return view('admin.room.member.edit', compact('room', 'member', 'memberPivot'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, Room $room, User $member)
    {
        $validated = $request->validate([
            'role' => 'required|in:bendahara,sekretaris',
        ]);

        $memberExists = $room->members()->where('users.id', $member->id)->exists();
        
        if (!$memberExists) {
            return redirect()
                ->route('admin.room.member.index', $room->id)
                ->with('error', 'Anggota tidak ditemukan di organisasi ini.');
        }

        $oldRole = $room->members()->where('users.id', $member->id)->first()->pivot->role;

        if ($oldRole === $validated['role']) {
            return redirect()
                ->route('admin.room.member.index', $room->id)
                ->with('info', 'Tidak ada perubahan role.');
        }

        // Update role di users table
        $member->update(['role' => $validated['role']]);

        // Update role di pivot table
        $room->members()->updateExistingPivot($member->id, [
            'role' => $validated['role']
        ]);

        return redirect()
            ->route('admin.room.member.index', $room->id)
            ->with('success', 'Role ' . $member->name . ' berhasil diubah dari ' . ucfirst($oldRole) . ' menjadi ' . ucfirst($validated['role']) . '.');
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy(Room $room, User $member)
    {
        $memberExists = $room->members()->where('users.id', $member->id)->exists();
        
        if (!$memberExists) {
            return redirect()
                ->route('admin.room.member.index', $room->id)
                ->with('error', 'Anggota tidak ditemukan di organisasi ini.');
        }

        $memberData = $room->members()->where('users.id', $member->id)->first();
        $memberName = $memberData->name;
        $memberRole = $memberData->pivot->role;

        //  HAPUS USER DARI DATABASE (Hard Delete)
        // Ini otomatis akan hapus relasi di room_members juga (jika ada onDelete cascade)
        $member->delete();

        return redirect()
            ->route('admin.room.member.index', $room->id)
            ->with('success', $memberName . ' (' . ucfirst($memberRole) . ') berhasil dihapus dari sistem.');
    }

}
