<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\RoomMember;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RoomMemberController extends Controller
{
    public function index(Request $request, Room $room)
    {
        $members = $room->members()->orderBy('name')->get();
        
        // Hitung jumlah role yang sudah ada
        $roleCount = $room->members()
            ->select('room_members.role', DB::raw('count(*) as total'))
            ->groupBy('room_members.role')
            ->pluck('total', 'room_members.role')
            ->toArray();
        
        return view('admin.room.member.index', compact('room', 'members', 'roleCount'));
    }

    public function create(Room $room)
    {
        // Hitung jumlah role yang sudah ada untuk validasi di form
        $existingRoles = $room->members()
            ->select('room_members.role', DB::raw('count(*) as total'))
            ->groupBy('room_members.role')
            ->pluck('total', 'room_members.role')
            ->toArray();
        
        $roles = ['bendahara', 'sekretaris'];
        
        return view('admin.room.member.create', compact('room', 'roles', 'existingRoles'));
    }

    public function store(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:bendahara,sekretaris',
        ]);

        // Validasi: Cek apakah role Bendahara atau Sekretaris sudah ada di room ini
        $existingRole = $room->members()
            ->wherePivot('role', $validated['role'])
            ->exists();

        if ($existingRole) {
            return back()->withErrors([
                'role' => 'Role ' . ucfirst($validated['role']) . ' sudah ada di organisasi ini. Setiap organisasi hanya boleh memiliki 1 orang dengan role ' . ucfirst($validated['role']) . '.'
            ])->withInput();
        }

        // Buat user baru
        $user = User::create([
            'name'      => $validated['name'],
            'username'  => (string) $validated['username'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'role'      => 'user', // Role di tabel users selalu 'user'
            'is_active' => true,  
        ]);

        // Tambahkan ke room dengan role di pivot table
        $room->members()->attach($user->id, ['role' => $validated['role']]);

        return redirect()
            ->route('admin.room.member.index', $room->id)
            ->with('success', 'Anggota berhasil ditambahkan sebagai ' . ucfirst($validated['role']) . ' di ' . $room->name . '.');
    }

    public function edit(Room $room, User $member)
    {
        // Ambil data pivot untuk member ini di room ini
        $memberPivot = $room->members()->where('users.id', $member->id)->first();
        
        if (!$memberPivot) {
            return redirect()
                ->route('admin.room.member.index', $room->id)
                ->with('error', 'Anggota tidak ditemukan di organisasi ini.');
        }

        // Hitung role yang sudah ada (exclude member yang sedang diedit)
        $existingRoles = $room->members()
            ->where('users.id', '!=', $member->id)
            ->select('room_members.role', DB::raw('count(*) as total'))
            ->groupBy('room_members.role')
            ->pluck('total', 'room_members.role')
            ->toArray();

        $roles = ['bendahara', 'sekretaris'];
        
        return view('admin.room.member.edit', compact('room', 'member', 'memberPivot', 'roles', 'existingRoles'));
    }

    public function update(Request $request, Room $room, User $member)
    {
        $validated = $request->validate([
            'role' => 'required|in:bendahara,sekretaris',
        ]);

        // Cek apakah member ada di room ini
        $memberExists = $room->members()->where('users.id', $member->id)->exists();
        
        if (!$memberExists) {
            return redirect()
                ->route('admin.room.member.index', $room->id)
                ->with('error', 'Anggota tidak ditemukan di organisasi ini.');
        }

        // Ambil role lama
        $oldRole = $room->members()->where('users.id', $member->id)->first()->pivot->role;

        // Jika role tidak berubah, langsung redirect
        if ($oldRole === $validated['role']) {
            return redirect()
                ->route('admin.room.member.index', $room->id)
                ->with('info', 'Tidak ada perubahan role.');
        }

        // Validasi: Cek apakah role baru sudah ada di room ini (exclude member ini)
        $existingRole = $room->members()
            ->where('users.id', '!=', $member->id)
            ->wherePivot('role', $validated['role'])
            ->exists();

        if ($existingRole) {
            return back()->withErrors([
                'role' => 'Role ' . ucfirst($validated['role']) . ' sudah ada di organisasi ini. Setiap organisasi hanya boleh memiliki 1 orang dengan role ' . ucfirst($validated['role']) . '.'
            ])->withInput();
        }

        // Update role di pivot table
        $room->members()->updateExistingPivot($member->id, [
            'role' => $validated['role']
        ]);

        return redirect()
            ->route('admin.room.member.index', $room->id)
            ->with('success', 'Role ' . $member->name . ' berhasil diubah dari ' . ucfirst($oldRole) . ' menjadi ' . ucfirst($validated['role']) . '.');
    }

    public function destroy(Room $room, User $member)
    {
        // Cek apakah member ada di room ini
        $memberExists = $room->members()->where('users.id', $member->id)->exists();
        
        if (!$memberExists) {
            return redirect()
                ->route('admin.room.member.index', $room->id)
                ->with('error', 'Anggota tidak ditemukan di organisasi ini.');
        }

        // Ambil nama dan role sebelum dihapus untuk pesan
        $memberData = $room->members()->where('users.id', $member->id)->first();
        $memberName = $memberData->name;
        $memberRole = $memberData->pivot->role;

        // Hapus dari pivot table room_members
        $room->members()->detach($member->id);

        return redirect()
            ->route('admin.room.member.index', $room->id)
            ->with('success', $memberName . ' (' . ucfirst($memberRole) . ') berhasil dihapus dari ' . $room->name . '.');
    }
}
