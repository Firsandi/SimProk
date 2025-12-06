@extends('layouts.user')

@section('title', 'Documents')
@section('page-title', 'My Documents')
@section('page-subtitle', 'Kelola dokumen yang telah Anda upload')

@section('content')
<div class="mx-auto max-w-7xl">

    <!-- Header with Gradient -->
    <div class="relative p-8 mb-8 overflow-hidden text-white shadow-xl bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600 rounded-2xl">
        <div class="absolute top-0 right-0 w-64 h-64 -mt-32 -mr-32 bg-white rounded-full opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 -mb-24 -ml-24 bg-white rounded-full opacity-10"></div>
        
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center bg-white w-14 h-14 rounded-xl bg-opacity-20 backdrop-blur-sm">
                        <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="mb-1 text-3xl font-black text-white">My Documents</h1>
                        <p class="text-teal-100">Total: <strong>{{ $documents->total() }}</strong> dokumen terupload</p>
                    </div>
                </div>
                <a href="{{ route('user.myprokers') }}" 
                   class="flex items-center gap-2 px-5 py-3 text-sm font-bold text-teal-600 transition bg-white shadow-lg rounded-xl hover:scale-105 hover:shadow-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    Upload Dokumen
                </a>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="flex items-start gap-3 p-4 mb-6 duration-300 border-l-4 border-green-500 shadow-sm rounded-xl bg-green-50 animate-in slide-in-from-top-2">
            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-sm font-bold text-green-900">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="flex items-start gap-3 p-4 mb-6 duration-300 border-l-4 border-red-500 shadow-sm rounded-xl bg-red-50 animate-in slide-in-from-top-2">
            <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-sm font-bold text-red-900">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Documents Table -->
    <div class="overflow-hidden bg-white shadow-lg rounded-2xl">
        @if ($documents->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b-2 border-gray-200 bg-gradient-to-r from-gray-50 to-teal-50/30">
                        <tr>
                            <th class="px-6 py-4 text-sm font-black tracking-wider text-left text-gray-900 uppercase">Dokumen</th>
                            <th class="px-6 py-4 text-sm font-black tracking-wider text-left text-gray-900 uppercase">Tipe</th>
                            <th class="px-6 py-4 text-sm font-black tracking-wider text-left text-gray-900 uppercase">Program Kerja</th>
                            <th class="px-6 py-4 text-sm font-black tracking-wider text-left text-gray-900 uppercase">Status</th>
                            <th class="px-6 py-4 text-sm font-black tracking-wider text-left text-gray-900 uppercase">Tanggal</th>
                            <th class="px-6 py-4 text-sm font-black tracking-wider text-center text-gray-900 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($documents as $doc)
                            <tr class="transition hover:bg-teal-50/30 group">
                                <!-- Dokumen -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 transition shadow-md rounded-xl bg-gradient-to-br from-teal-500 to-emerald-600 group-hover:scale-110">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900 transition-colors group-hover:text-teal-600">{{ $doc->title }}</p>
                                            <p class="flex items-center gap-1 text-xs text-gray-500">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                </svg>
                                                {{ $doc->room->name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Tipe -->
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-gray-700 border-2 border-gray-200 rounded-lg bg-gray-50">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        {{ ucfirst(str_replace('_', ' ', $doc->document_type)) }}
                                    </span>
                                </td>

                                <!-- Proker -->
                                <td class="px-6 py-4">
                                    <p class="text-sm font-semibold text-gray-700">{{ $doc->proker->name ?? '-' }}</p>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @if ($doc->latestStatus)
                                        @if($doc->latestStatus->status === 'approved')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-green-700 border-2 border-green-200 rounded-lg bg-green-50">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Approved
                                            </span>
                                        @elseif($doc->latestStatus->status === 'revision')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-blue-700 border-2 border-blue-200 rounded-lg bg-blue-50">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                </svg>
                                                Revision
                                            </span>
                                        @elseif($doc->latestStatus->status === 'rejected')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-red-700 border-2 border-red-200 rounded-lg bg-red-50">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Rejected
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-yellow-700 border-2 border-yellow-200 rounded-lg bg-yellow-50">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ ucfirst($doc->latestStatus->status) }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-yellow-700 border-2 border-yellow-200 rounded-lg bg-yellow-50">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                <!-- Tanggal -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1.5 text-sm text-gray-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="font-semibold">{{ $doc->submitted_at->format('d M Y') }}</span>
                                    </div>
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- View Button -->
                                        <a href="{{ route('user.documents.show', $doc->id) }}" 
                                           class="inline-flex items-center justify-center text-blue-600 transition border-2 border-blue-200 rounded-lg w-9 h-9 bg-blue-50 hover:bg-blue-100 hover:scale-110"
                                           title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>

                                        <!-- Download Button -->
                                        <a href="{{ route('user.documents.download', $doc->id) }}" 
                                           class="inline-flex items-center justify-center text-green-600 transition border-2 border-green-200 rounded-lg w-9 h-9 bg-green-50 hover:bg-green-100 hover:scale-110"
                                           title="Download">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                        </a>

                                        <!-- Delete Button (only if pending) -->
                                        @if ($doc->isPending())
                                            <form action="{{ route('user.documents.destroy', $doc->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="event.preventDefault(); confirmAction(this.closest('form'), {
                                                        title: 'Konfirmasi Hapus',
                                                        text: 'Yakin ingin menghapus dokumen ini?',
                                                        confirmText: 'Ya, hapus',
                                                        cancelText: 'Batal',
                                                        icon: 'warning'
                                                    });"
                                                    class="inline-flex items-center justify-center text-red-600 transition border-2 border-red-200 rounded-lg w-9 h-9 bg-red-50 hover:bg-red-100 hover:scale-110"
                                                    title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
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
            <div class="px-6 py-4 border-t-2 border-gray-100 bg-gradient-to-r from-gray-50 to-teal-50/30">
                {{ $documents->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="py-16 text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 mb-6 rounded-full bg-gradient-to-br from-gray-100 to-teal-50">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="mb-2 text-xl font-black text-gray-900">Belum Ada Dokumen</h3>
                <p class="mb-6 text-sm text-gray-500">Anda belum mengupload dokumen apapun</p>
                <a href="{{ route('user.myprokers') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-white transition shadow-lg bg-gradient-to-r from-teal-600 to-emerald-600 rounded-xl hover:scale-105 hover:shadow-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Upload Dokumen Pertama
                </a>
            </div>
        @endif
    </div>

</div>

<style>
@keyframes slide-in-from-top-2 {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-in {
    animation: slide-in-from-top-2 0.3s ease-out;
}
</style>
@endsection
