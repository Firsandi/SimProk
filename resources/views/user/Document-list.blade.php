@extends('layouts.user')

@section('title', 'Documents')
@section('page-title', 'My Documents')
@section('page-subtitle', 'Kelola dokumen yang telah Anda upload')

@section('content')
<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900">📄 My Documents</h1>
            <p class="mt-1 text-gray-500">Total: <strong>{{ $documents->total() }}</strong> dokumen</p>
        </div>
        <a href="{{ route('user.myprokers') }}" 
           class="flex items-center px-5 py-2 font-semibold text-white transition bg-teal-600 rounded-lg hover:bg-teal-700">
            <i class="mr-2 fas fa-plus"></i>
            Upload Dokumen
        </a>
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="p-4 mb-6 border-l-4 border-green-500 rounded-r-lg bg-green-50">
            <p class="flex items-center font-semibold text-green-900">
                <i class="mr-2 fas fa-check-circle"></i>
                {{ session('success') }}
            </p>
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 mb-6 border-l-4 border-red-500 rounded-r-lg bg-red-50">
            <p class="flex items-center font-semibold text-red-900">
                <i class="mr-2 fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </p>
        </div>
    @endif

    <!-- Documents Table -->
    <div class="overflow-hidden bg-white shadow-sm rounded-xl">
        @if ($documents->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b-2 border-gray-200 bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-700">Judul</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-700">Tipe</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-700">Proker</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-700">Status</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-700">Tanggal</th>
                            <th class="px-6 py-4 text-sm font-semibold text-center text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($documents as $doc)
                            <tr class="transition hover:bg-gray-50">
                                <!-- Judul -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-teal-100 rounded-lg">
                                            <i class="text-teal-600 fas fa-file-pdf"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $doc->title }}</p>
                                            <p class="text-xs text-gray-500">{{ $doc->room->name }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Tipe -->
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-full">
                                        {{ ucfirst(str_replace('_', ' ', $doc->document_type)) }}
                                    </span>
                                </td>

                                <!-- Proker -->
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $doc->proker->name ?? '-' }}
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @if ($doc->latestStatus)
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                                            @if ($doc->latestStatus->status === 'approved') bg-green-100 text-green-800
                                            @elseif ($doc->latestStatus->status === 'revision') bg-blue-100 text-blue-800
                                            @elseif ($doc->latestStatus->status === 'rejected') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800
                                            @endif">
                                            {{ $doc->latestStatus->getStatusIcon() }} {{ ucfirst($doc->latestStatus->status) }}
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                            ⏳ Pending
                                        </span>
                                    @endif
                                </td>

                                <!-- Tanggal -->
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $doc->submitted_at->format('d M Y') }}
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('user.documents.show', $doc->id) }}" 
                                           class="px-3 py-1 text-sm font-semibold text-white transition bg-blue-600 rounded hover:bg-blue-700"
                                           title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('user.documents.download', $doc->id) }}" 
                                           class="px-3 py-1 text-sm font-semibold text-white transition bg-green-600 rounded hover:bg-green-700"
                                           title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        @if ($doc->isPending())
                                            <form action="{{ route('user.documents.destroy', $doc->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus dokumen ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="px-3 py-1 text-sm font-semibold text-white transition bg-red-600 rounded hover:bg-red-700"
                                                        title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t bg-gray-50">
                {{ $documents->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="py-16 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 mb-4 bg-gray-100 rounded-full">
                    <i class="text-4xl text-gray-400 fas fa-folder-open"></i>
                </div>
                <h3 class="mb-2 text-lg font-semibold text-gray-700">Belum Ada Dokumen</h3>
                <p class="mb-4 text-gray-500">Anda belum mengupload dokumen apapun</p>
                <a href="{{ route('user.myprokers') }}" 
                   class="inline-flex items-center px-5 py-2 font-semibold text-white transition bg-teal-600 rounded-lg hover:bg-teal-700">
                    <i class="mr-2 fas fa-plus"></i>
                    Upload Dokumen Pertama
                </a>
            </div>
        @endif
    </div>

</div>
@endsection
