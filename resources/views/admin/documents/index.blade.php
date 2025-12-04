@extends('layouts.admin')

@section('title', 'Kelola Dokumen')

@section('content')
<div class="mx-auto max-w-screen-2xl">

    <!-- Header dengan gradient background -->
    <div class="relative p-8 mb-8 overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 rounded-2xl">
        <div class="absolute top-0 right-0 w-64 h-64 transform translate-x-32 -translate-y-32 bg-white rounded-full opacity-5"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 transform -translate-x-24 translate-y-24 bg-white rounded-full opacity-5"></div>
        
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="flex items-center justify-center w-12 h-12 bg-white rounded-xl bg-opacity-20 backdrop-blur-sm">
                        <i class="text-xl text-white fas fa-file-alt"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-white">Kelola Dokumen</h1>
                </div>
                <p class="text-blue-100">
                    Pantau dan kelola semua dokumen dari UKM/Ormawa secara terpusat
                </p>
            </div>
            
            <a href="{{ route('admin.dokumen.index') }}"
               class="inline-flex items-center gap-2 px-5 py-3 text-sm font-semibold text-blue-600 transition bg-white shadow-lg rounded-xl hover:shadow-xl hover:scale-105">
                <i class="fas fa-folder-open"></i>
                Lihat Semua Dokumen
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-4">
        <div class="p-6 transition bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-md">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-green-50">
                    <i class="text-xl text-green-600 fas fa-check-circle"></i>
                </div>
                <span class="text-xs font-semibold text-green-600 uppercase bg-green-50 px-2.5 py-1 rounded-full">Approved</span>
            </div>
            <p class="mb-1 text-2xl font-bold text-gray-900">
                {{ $documents->where('latestStatus.status', 'approved')->count() }}
            </p>
            <p class="text-xs text-gray-500">Dokumen disetujui</p>
        </div>

        <div class="p-6 transition bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-md">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-yellow-50">
                    <i class="text-xl text-yellow-600 fas fa-hourglass-half"></i>
                </div>
                <span class="text-xs font-semibold text-yellow-600 uppercase bg-yellow-50 px-2.5 py-1 rounded-full">Pending</span>
            </div>
            <p class="mb-1 text-2xl font-bold text-gray-900">
                {{ $documents->where('latestStatus.status', 'pending')->count() }}
            </p>
            <p class="text-xs text-gray-500">Menunggu review</p>
        </div>

        <div class="p-6 transition bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-md">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-orange-50">
                    <i class="text-xl text-orange-600 fas fa-edit"></i>
                </div>
                <span class="text-xs font-semibold text-orange-600 uppercase bg-orange-50 px-2.5 py-1 rounded-full">Revision</span>
            </div>
            <p class="mb-1 text-2xl font-bold text-gray-900">
                {{ $documents->whereIn('latestStatus.status', ['revision', 'revisi'])->count() }}
            </p>
            <p class="text-xs text-gray-500">Perlu revisi</p>
        </div>

        <div class="p-6 transition bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-md">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-red-50">
                    <i class="text-xl text-red-600 fas fa-times-circle"></i>
                </div>
                <span class="text-xs font-semibold text-red-600 uppercase bg-red-50 px-2.5 py-1 rounded-full">Rejected</span>
            </div>
            <p class="mb-1 text-2xl font-bold text-gray-900">
                {{ $documents->where('latestStatus.status', 'rejected')->count() }}
            </p>
            <p class="text-xs text-gray-500">Dokumen ditolak</p>
        </div>
    </div>

    <!-- Table Card dengan design modern -->
    <div class="overflow-hidden bg-white border-0 shadow-lg rounded-2xl">
        <!-- Toolbar dengan search & filter -->
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Daftar Dokumen</h3>
                    <p class="text-sm text-gray-500">
                        Menampilkan {{ $documents->firstItem() ?? 0 }}–{{ $documents->lastItem() ?? 0 }}
                        dari {{ $documents->total() }} total dokumen
                    </p>
                </div>
                
                <!-- Search bar (optional) -->
                <div class="flex gap-2">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Cari dokumen..." 
                               class="w-full py-2 pl-10 pr-4 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500">
                        <i class="absolute text-gray-400 transform -translate-y-1/2 fas fa-search left-3 top-1/2"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table dengan hover effect yang smooth -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="text-xs font-semibold tracking-wider text-gray-600 uppercase border-b border-gray-200 bg-gray-50/50">
                        <th class="px-6 py-4 text-left">Dokumen</th>
                        <th class="px-6 py-4 text-left">Tipe</th>
                        <th class="px-6 py-4 text-left">Organisasi</th>
                        <th class="px-6 py-4 text-left">Program Kerja</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-left">Waktu Upload</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($documents as $doc)
                        @php
                            $status = strtolower($doc->latestStatus->status ?? 'pending');
                            $statusConfig = match($status) {
                                'disetujui', 'approved' => [
                                    'bg' => 'bg-green-50',
                                    'text' => 'text-green-700',
                                    'icon' => 'fas fa-check-circle',
                                    'label' => 'Disetujui'
                                ],
                                'pending', 'menunggu', 'diproses' => [
                                    'bg' => 'bg-yellow-50',
                                    'text' => 'text-yellow-700',
                                    'icon' => 'fas fa-clock',
                                    'label' => 'Pending'
                                ],
                                'revision', 'revisi' => [
                                    'bg' => 'bg-orange-50',
                                    'text' => 'text-orange-700',
                                    'icon' => 'fas fa-edit',
                                    'label' => 'Revisi'
                                ],
                                'rejected', 'ditolak' => [
                                    'bg' => 'bg-red-50',
                                    'text' => 'text-red-700',
                                    'icon' => 'fas fa-times-circle',
                                    'label' => 'Ditolak'
                                ],
                                default => [
                                    'bg' => 'bg-gray-50',
                                    'text' => 'text-gray-700',
                                    'icon' => 'fas fa-info-circle',
                                    'label' => 'Unknown'
                                ]
                            };
                        @endphp
                        <tr class="transition-all duration-200 hover:bg-blue-50/30 group">
                            <td class="px-6 py-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600">
                                        <i class="text-white fas fa-file-alt"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 line-clamp-1 group-hover:text-blue-600">
                                            {{ $doc->title }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            oleh {{ $doc->submitter->name }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-lg bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-sm">
                                    <i class="fas fa-tag text-[10px]"></i>
                                    {{ strtoupper($doc->document_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900">{{ $doc->room->name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-700">{{ $doc->proker->nama_proker ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-lg {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} shadow-sm">
                                        <i class="{{ $statusConfig['icon'] }} text-[10px]"></i>
                                        {{ $statusConfig['label'] }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <i class="text-xs text-gray-400 far fa-calendar-alt"></i>
                                    {{ $doc->submitted_at->format('d M Y') }}
                                </div>
                                <div class="flex items-center gap-2 mt-1 text-xs text-gray-400">
                                    <i class="text-[10px] far fa-clock"></i>
                                    {{ $doc->submitted_at->format('H:i') }} WIB
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.dokumen.show', $doc->id) }}"
                                       class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-white transition-all duration-200 rounded-lg shadow-sm bg-gradient-to-r from-blue-600 to-blue-700 hover:shadow-lg hover:scale-105">
                                        <i class="fas fa-eye text-[11px]"></i>
                                        Review
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gray-50">
                                        <i class="text-3xl text-gray-300 fas fa-inbox"></i>
                                    </div>
                                    <p class="mb-2 text-lg font-semibold text-gray-900">Belum Ada Dokumen</p>
                                    <p class="text-sm text-gray-500">Dokumen yang diupload akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination dengan design modern -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex flex-col items-center justify-between gap-3 sm:flex-row">
                <div class="text-sm text-gray-600">
                    Menampilkan 
                    <span class="font-semibold text-gray-900">{{ $documents->firstItem() ?? 0 }}</span>
                    sampai 
                    <span class="font-semibold text-gray-900">{{ $documents->lastItem() ?? 0 }}</span>
                    dari 
                    <span class="font-semibold text-gray-900">{{ $documents->total() }}</span>
                    dokumen
                </div>
                <div>
                    {{ $documents->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
