@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Anggota Room: {{ $room->name }}</h2>

    <a href="{{ route('admin.room.member.create', $room->id) }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 mb-4 inline-block">
       +Tambah Anggota
    </a>
    
    <!-- Tombol balik ke dashboard -->
    <a href="{{ route('admin.room.proker.index', ['room' => $room->id]) }}"
        class="bg-gray-700 text-white px-5 py-2 rounded-lg shadow hover:bg-gray-800 transition">
        ← Kembali ke Dashboard
    </a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Username</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr>
                    <td class="border px-4 py-2">{{ $member->name }}</td>
                    <td class="border px-4 py-2">{{ $member->username }}</td>
                    <td class="border px-4 py-2">{{ $member->email }}</td>
                    <td class="border px-4 py-2">{{ $member->pivot->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
