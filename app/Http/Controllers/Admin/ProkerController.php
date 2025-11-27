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
        $anggotaRoom = $room->members()->orderBy('name')->get();
        return view('admin.room.proker.index', compact('room', 'prokers','anggotaRoom'));
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
    public function store(Request $request, Room $room, Proker $proker)
    {
        $request->validate([
            'nama_proker' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:2100',
            'deskripsi' => 'nullable|string',
            'members'     => 'nullable|array',
            'members.*'   => 'exists:users,id',
        ]);

        $room->prokers()->create([
            'nama_proker' => $request->nama_proker,
            'tahun' => $request->tahun,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->filled('members')) {
        $proker->members()->attach($request->members);
        }

        return redirect()->route('admin.room.proker.index', $room->id)->with('success', 'Program kerja berhasil ditambahkan.');
    }


    public function edit(Room $room, Proker $proker)
    {
        $anggotaRoom = $room->members()->orderBy('name')->get();
        $roles = ['bendahara', 'sekretaris'];
        return view('admin.room.proker.edit', compact('room', 'proker','anggotaRoom','roles'));
    }

    public function update(Request $request, Room $room, Proker $proker)
    {
        $request->validate([
            'nama_proker' => 'required|string|max:100',
            'tahun'       => 'required|integer',
            'deskripsi'   => 'nullable|string',
            'members' => 'nullable|array',
            'members.*.user_id' => 'required|exists:users,id',
        ]);

       $proker->update([
        'nama_proker' => $request->nama_proker,
        'tahun'       => $request->tahun,
        'deskripsi'   => $request->deskripsi,
        ]);

         if ($request->filled('member_id')) {
        $proker->members()->sync([$request->member_id]);
        } else { 
            $proker->members()->detach(); // kosongkan kalau tidak dipilih
        }

        return redirect()->route('admin.room.proker.show',['room'=>$room->id, $proker->id])->with('success', 'Proker berhasil diperbarui');
    }

    public function show(Room $room, Proker $proker)
    {
        $members = $proker->members()->get();

        return view('admin.room.proker.show', compact('room', 'proker', 'members'));
    }

    public function destroy($roomId, $prokerId)
    {
        $proker->delete();

        return redirect()->route('admin.room.proker.index', $roomId)->with('success', 'Proker berhasil dihapus');
    }


}
