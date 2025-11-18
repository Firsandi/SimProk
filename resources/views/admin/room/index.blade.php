@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow rounded p-6">
    <h2 class="text-xl font-semibold mb-4">Daftar UKM / Ormawa</h2>

    <a href="{{ route('admin.room.create') }}" 
       class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 mb-4 inline-block">
        + Tambah UKM / Ormawa
    </a>

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Periode</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td class="border px-4 py-2">{{ $room->name }}</td>
                    <td class="border px-4 py-2">{{ $room->period }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($room->status) }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ route('admin.room.edit', $room->id) }}" 
                           class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.room.destroy', $room->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline"
                                    onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
