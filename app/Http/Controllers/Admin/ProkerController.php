<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomProker;

class ProkerController extends Controller
{
    /**
     * Tampilkan daftar proker untuk room tertentu.
     */
    public function index(Room $room)
    {
        // Proker milik room ini
        $prokers = $room->prokers()->latest()->get();

        // Anggota room untuk kebutuhan lain (mis. filter di view)
        $anggotaRoom = $room->members()->orderBy('name')->get();

        return view('admin.room.proker.index', compact('room', 'prokers', 'anggotaRoom'));
    }

    /**
     * Tampilkan form create proker.
     */
    public function create(Room $room)
    {
        // List anggota room untuk dropdown di form create
        $anggotaRoom = $room->members()->orderBy('name')->get();

        return view('admin.room.proker.create', compact('room', 'anggotaRoom'));
    }

    /**
     * Simpan data proker baru.
     */
    public function store(Request $request, Room $room)
    {
        $validated = $request->validate([
            'nama_proker' => 'required|string|max:255',
            'tahun'       => 'required|integer|min:1900|max:2100',
            'deskripsi'   => 'nullable|string',
            'member_id'   => 'nullable|exists:users,id', // sementara belum dipakai
        ]);

        $proker = $room->prokers()->create([
            'nama_proker' => $validated['nama_proker'],
            'tahun'       => $validated['tahun'],
            'deskripsi'   => $validated['deskripsi'] ?? null,
            'user_id'     => auth()->id(), // creator
        ]);

        // BELUM ada relasi khusus anggota proker -> tidak ada attach/sync di sini

        return redirect()
            ->route('admin.room.proker.index', $room->id)
            ->with('success', 'Program kerja berhasil ditambahkan.');
    }

    /**
     * Form edit proker.
     * Pastikan $proker memang milik $room.
     */
    public function edit(Room $room, RoomProker $proker)
    {
        if ($proker->room_id !== $room->id) {
            abort(404);
        }

        // daftar anggota room untuk dropdown
        $anggotaRoom = $room->members()->orderBy('name')->get();

        return view('admin.room.proker.edit', compact('room', 'proker', 'anggotaRoom'));
    }

    /**
     * Update proker.
     */
    public function update(Request $request, Room $room, RoomProker $proker)
    {
        if ($proker->room_id !== $room->id) {
            abort(404);
        }

        $validated = $request->validate([
            'nama_proker' => 'required|string|max:255',
            'tahun'       => 'required|integer|min:1900|max:2100',
            'deskripsi'   => 'nullable|string',
            'member_id'   => 'nullable|exists:users,id', // sementara belum dipakai
        ]);

        $proker->update([
            'nama_proker' => $validated['nama_proker'],
            'tahun'       => $validated['tahun'],
            'deskripsi'   => $validated['deskripsi'] ?? null,
        ]);

        // overwrite anggota lama dengan anggota baru (hanya 1)
        if (!empty($validated['member_id'])) {
            $proker->members()->sync([$validated['member_id']]);
        } else {
        // kalau tidak pilih anggota, kosongkan pivot
            $proker->members()->sync([]);
    }

        return redirect()
            ->route('admin.room.proker.show', [$room->id, $proker->id])
            ->with('success', 'Proker berhasil diperbarui.');
    }

    /**
     * Detail proker.
     */
    public function show($room_id, $proker_id)
    {
        // load room + anggota room
        $room   = Room::findOrFail($room_id);
        $proker = RoomProker::with('members')->findOrFail($proker_id);

        // keamanan: pastikan proker milik room
        if ($proker->room_id !== $room->id) {
            abort(404);
        }

        // Untuk sekarang, anggota proker = anggota room
        $members = $proker->members;

        return view('admin.room.proker.show', compact('room', 'proker', 'members'));
    }

    /**
     * Hapus proker.
     */
    public function destroy(Room $room, RoomProker $proker)
    {
        if ($proker->room_id !== $room->id) {
            abort(404);
        }

        $proker->delete();

        return redirect()
            ->route('admin.room.proker.index', $room->id)
            ->with('success', 'Proker berhasil dihapus.');
    }
}
