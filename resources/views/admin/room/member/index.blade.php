@extends('layouts.admin')

@section('content')
<div class="max-w-4xl p-6 mx-auto bg-white rounded shadow">
    <h2 class="mb-4 text-2xl font-bold">Daftar Anggota Room: {{ $room->name }}</h2>

    <a href="{{ route('admin.room.member.create', $room->id) }}"
       class="inline-block px-4 py-2 mb-4 text-white bg-indigo-600 rounded hover:bg-indigo-700">
       +Tambah Anggota
    </a>
    
    <!-- Tombol balik ke dashboard -->
    <a href="{{ route('admin.room.proker.index', ['room' => $room->id]) }}"
        class="px-5 py-2 text-white transition bg-gray-700 rounded-lg shadow hover:bg-gray-800">
        ← Kembali ke Dashboard
    </a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">Username</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr>
                    <td class="px-4 py-2 border">{{ $member->name }}</td>
                    <td class="px-4 py-2 border">{{ $member->username }}</td>
                    <td class="px-4 py-2 border">{{ $member->email }}</td>
                    <td class="px-4 py-2 border">{{ $member->pivot->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
