@extends('layouts.admin')

@section('title', 'Kelola Dokumen')

@section('content')
<div class="max-w-screen-xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">📄 Semua Dokumen</h2>

    <table class="w-full table-auto bg-white shadow rounded">
        <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
            <tr>
                <th class="p-3">Judul</th>
                <th class="p-3">Tipe</th>
                <th class="p-3">UKM/Ormawa</th>
                <th class="p-3">Proker</th>
                <th class="p-3">Status</th>
                <th class="p-3">Tanggal Upload</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm text-gray-600">
            @foreach($documents as $doc)
                <tr class="border-t">
                    <td class="p-3 font-medium">{{ $doc->title }}</td>
                    <td class="p-3">{{ strtoupper($doc->document_type) }}</td>
                    <td class="p-3">{{ $doc->room->name }}</td>
                    <td class="p-3">{{ $doc->proker->nama_proker ?? '-' }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-100">
                            {{ ucfirst($doc->latestStatus->status ?? 'Belum ada') }}
                        </span>
                    </td>
                    <td class="p-3">{{ $doc->submitted_at->format('d M Y H:i') }}</td>
                    <td class="p-3">
                        <a href="{{ route('admin.dokumen.show', $doc->id) }}" class="text-blue-600 hover:underline">Lihat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        {{ $documents->links() }}
    </div>
</div>
@endsection
