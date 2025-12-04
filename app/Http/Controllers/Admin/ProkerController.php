<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomProker;
use App\Models\User;
use App\Notifications\UserAddedToProkerNotification;
use Illuminate\Http\Request;

class ProkerController extends Controller
{
    /**
     * Display a listing of prokers.
     */
    public function index(Room $room)
    {
        $prokers = $room->prokers()
            ->orderBy('tahun', 'desc')
            ->orderBy('nama_proker')
            ->get();

        return view('admin.room.proker.index', compact('room', 'prokers'));
    }

    /**
     * Show the form for creating a new proker.
     */
    public function create(Room $room)
    {
        return view('admin.room.proker.create', compact('room'));
    }

    /**
     * Store a newly created proker in storage.
     */
    public function store(Request $request, Room $room)
    {
        $validated = $request->validate([
            'nama_proker' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:2099',
            'deskripsi' => 'nullable|string',
        ]);

        $proker = $room->prokers()->create([
            'nama_proker' => $validated['nama_proker'],
            'tahun' => $validated['tahun'],
            'deskripsi' => $validated['deskripsi'],
        ]);

        return redirect()
            ->route('admin.room.proker.index', $room->id)
            ->with('success', 'Program kerja "' . $proker->nama_proker . '" berhasil ditambahkan!');
    }

    /**
     * Display the specified proker.
     */
    public function show(Room $room, RoomProker $proker)
    {
        // Load members proker dengan pivot role
        $members = $proker->members()
            ->withPivot('role')
            ->orderBy('name')
            ->get();

        // ✅ AMBIL USER YANG BELUM ADA DI PROKER INI
        // Filter: user harus anggota room DAN belum di proker ini
        $availableMembers = $room->members()
            ->whereNotIn('users.id', $members->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('admin.room.proker.show', compact('room', 'proker', 'members', 'availableMembers'));
    }

    /**
     * Show the form for editing the specified proker.
     */
    public function edit(Room $room, RoomProker $proker)
    {
        return view('admin.room.proker.edit', compact('room', 'proker'));
    }

    /**
     * Update the specified proker in storage.
     */
    public function update(Request $request, Room $room, RoomProker $proker)
    {
        $validated = $request->validate([
            'nama_proker' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:2099',
            'deskripsi' => 'nullable|string',
        ]);

        $proker->update($validated);

        return redirect()
            ->route('admin.room.proker.show', [$room->id, $proker->id])
            ->with('success', 'Program kerja berhasil diperbarui!');
    }

    /**
     * Remove the specified proker from storage.
     */
    public function destroy(Room $room, RoomProker $proker)
    {
        $prokerName = $proker->nama_proker;
        $proker->delete();

        return redirect()
            ->route('admin.room.proker.index', $room->id)
            ->with('success', 'Program kerja "' . $prokerName . '" berhasil dihapus!');
    }

    /**
     * Add a member to the proker.
     */
    public function addMember(Request $request, Room $room, RoomProker $proker)
    {
        // ✅ VALIDASI: Hanya butuh user_id, role ambil dari tabel users
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // ✅ AMBIL USER
        $user = User::findOrFail($validated['user_id']);

        // ✅ CEK: Apakah user adalah anggota room ini?
        if (!$room->members()->where('users.id', $user->id)->exists()) {
            return redirect()
                ->back()
                ->with('error', 'User "' . $user->name . '" bukan anggota dari organisasi ' . $room->name . '.');
        }

        // ✅ CEK: Apakah user sudah ada di proker ini?
        if ($proker->members()->where('users.id', $user->id)->exists()) {
            return redirect()
                ->back()
                ->with('error', $user->name . ' sudah menjadi anggota proker ini.');
        }

        // ✅ CEK: Apakah role ini sudah ada di proker? (1 sekretaris, 1 bendahara per proker)
        $existingRoleInProker = $proker->members()
            ->wherePivot('role', $user->role)
            ->exists();

        if ($existingRoleInProker) {
            return redirect()
                ->back()
                ->with('error', 'Role ' . ucfirst($user->role) . ' sudah terisi di proker ini. Setiap proker hanya boleh memiliki 1 Sekretaris dan 1 Bendahara.');
        }

        // ✅ ATTACH USER KE PROKER (role ambil dari users.role)
        $proker->members()->attach($user->id, [
            'role' => $user->role, // Ambil dari tabel users
        ]);

        // ✅ KIRIM NOTIFIKASI
        $user->notify(new UserAddedToProkerNotification($proker, $room));

        return redirect()
            ->back()
            ->with('success', $user->name . ' (' . ucfirst($user->role) . ') berhasil ditambahkan ke proker dan notifikasi telah dikirim!');
    }

    /**
     * Remove a member from the proker.
     */
    public function removeMember(Request $request, Room $room, RoomProker $proker)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($validated['user_id']);

        // Cek apakah user ada di proker
        if (!$proker->members()->where('users.id', $user->id)->exists()) {
            return redirect()
                ->back()
                ->with('error', 'User tidak ditemukan di proker ini.');
        }

        // Ambil role untuk pesan sukses
        $userRole = $proker->members()->where('users.id', $user->id)->first()->pivot->role;

        // Hapus dari proker
        $proker->members()->detach($user->id);

        return redirect()
            ->back()
            ->with('success', $user->name . ' (' . ucfirst($userRole) . ') berhasil dihapus dari proker.');
    }
}
