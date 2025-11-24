<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Proker;

class ProkerController extends Controller
{
    /**
     * Tampilkan daftar proker untuk room tertentu.
     */
    public function index(Room $room)
    {
        $prokers = $room->prokers()->latest()->get();
        return view('admin.room.proker.index', compact('room', 'prokers'));
    }

    /**
     * Tampilkan form create proker.
     */
    public function create(Room $room)
    {
        return view('admin.room.proker.create', compact('room'));
    }

    /**
     * Simpan data proker baru.
     */
    public function store(Request $request, Room $room)
    {
        $request->validate([
            'nama_proker' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:2100',
            'deskripsi' => 'nullable|string',
        ]);

        $room->prokers()->create([
            'nama_proker' => $request->nama_proker,
            'tahun' => $request->tahun,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.room.proker.index', $room->id)
                         ->with('success', 'Program kerja berhasil ditambahkan.');
    }


    public function edit($roomId, $prokerId)
    {
        $room = Room::findOrFail($roomId);
        $proker = Proker::where('room_id', $roomId)->findOrFail($prokerId);

        return view('admin.room.proker.edit', compact('room', 'proker'));
    }

    public function update(Request $request, $roomId, $prokerId)
    {
        $request->validate([
            'nama_proker' => 'required|string|max:100',
            'tahun'       => 'required|integer',
            'deskripsi'   => 'nullable|string',
        ]);

        $proker = Proker::where('room_id', $roomId)->findOrFail($prokerId);

        $proker->update([
            'nama_proker' => $request->nama_proker,
            'tahun'       => $request->tahun,
            'deskripsi'   => $request->deskripsi,
        ]);

        return redirect()->route('admin.room.proker.index', $roomId)
                        ->with('success', 'Proker berhasil diupdate');
    }

    public function destroy($roomId, $prokerId)
{
    $proker = Proker::where('room_id', $roomId)->findOrFail($prokerId);
    $proker->delete();

    return redirect()->route('admin.room.proker.index', $roomId)
                     ->with('success', 'Proker berhasil dihapus');
}
}
