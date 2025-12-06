<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::with(['members', 'prokers']);
        
        //  FILTER berdasarkan PERIODE (jika ada parameter ?period=2024)
        if ($request->has('period') && $request->period != '') {
            $query->where('period', $request->period);
        }
        
        //  FILTER berdasarkan STATUS (jika ada parameter ?status=active)
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        //  FILTER berdasarkan JENIS ORGANISASI (jika ada parameter ?org_type=ukm)
        if ($request->has('org_type') && $request->org_type != '') {
            $query->where('organization_type', $request->org_type);
        }
        
        $rooms = $query->latest()
            ->get()
            ->map(function($room) {
                return [
                    'id'            => $room->id,
                    'name'          => $room->name,
                    'period'        => $room->period,
                    'status'        => $room->status,
                    'organization_type' => $room->organization_type,
                    'members_count' => $room->members->count(),
                    'prokers_count' => $room->prokers->count(),
                ];
            });
        
        //  Ambil daftar PERIODE yang ada untuk dropdown filter (distinct)
        $periods = Room::select('period')
            ->distinct()
            ->orderBy('period', 'desc')
            ->pluck('period');

        return view('admin.room.index', compact('rooms', 'periods'));
    }


    public function create()
    {
        //  Kirim tahun sekarang ke view
        $currentYear = date('Y');
        return view('admin.room.create', compact('currentYear'));
    }

    public function store(Request $request)
    {
        $currentYear = date('Y');
        
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:rooms,name', //  Validasi unique
            ],
            'period' => [
                'required',
                'integer', //  Harus angka (tahun)
                'min:' . $currentYear, //  Tidak boleh < tahun sekarang
                'max:' . ($currentYear + 10),
            ],
            'status' => 'required|in:active,inactive',
            'organization_type' => 'required|string',
            'room_type' => 'nullable|string',
        ], [
            // Custom error messages
            'name.required' => 'Nama UKM/Ormawa tidak boleh kosong',
            'name.unique' => 'Nama UKM/Ormawa sudah digunakan', // ⭐ Pesan duplikasi
            'name.max' => 'Nama UKM/Ormawa maksimal 255 karakter',
            
            'period.required' => 'Periode tidak boleh kosong',
            'period.integer' => 'Periode harus berupa tahun (angka)',
            'period.min' => 'Periode tidak boleh kurang dari tahun ' . $currentYear,
            'period.max' => 'Periode terlalu jauh ke depan',
            
            'status.required' => 'Status tidak boleh kosong',
            'organization_type.required' => 'Jenis organisasi tidak boleh kosong',
        ]);

        Room::create([
            ...$validated,
            'admin_id' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.room.index')
            ->with('success', 'UKM/Ormawa berhasil ditambahkan.');
    }

    public function edit(Room $room)
    {
        //  Kirim tahun sekarang ke view
        $currentYear = date('Y');
        return view('admin.room.edit', compact('room', 'currentYear'));
    }

    public function update(Request $request, Room $room)
    {
        $currentYear = date('Y');
        
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                //  Unique kecuali diri sendiri
                Rule::unique('rooms', 'name')->ignore($room->id),
            ],
            'period' => [
                'required',
                'integer',
                'min:' . $currentYear,
                'max:' . ($currentYear + 10),
            ],
            'status' => 'required|in:active,inactive',
            'organization_type' => 'nullable|string',
            'color' => 'nullable|string',
            'room_type' => 'nullable|string',
        ], [
            'name.required' => 'Nama UKM/Ormawa tidak boleh kosong',
            'name.unique' => 'Nama UKM/Ormawa sudah digunakan',
            'name.max' => 'Nama UKM/Ormawa maksimal 255 karakter',
            
            'period.required' => 'Periode tidak boleh kosong',
            'period.integer' => 'Periode harus berupa tahun (angka)',
            'period.min' => 'Periode tidak boleh kurang dari tahun ' . $currentYear,
            'period.max' => 'Periode terlalu jauh ke depan',
            
            'status.required' => 'Status tidak boleh kosong',
        ]);

        $room->update($validated);

        return redirect()
            ->route('admin.room.index')
            ->with('success', 'UKM/Ormawa berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        
        return redirect()
            ->route('admin.room.index')
            ->with('success', 'UKM/Ormawa berhasil dihapus.');
    }
}
