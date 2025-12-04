@extends('layouts.admin')

@section('title', 'Kelola Dokumen')

@section('content')
<div class="mx-auto max-w-screen-2xl">

    <!-- Header & Subheader -->
    <div class="flex flex-col justify-between gap-3 mb-6 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">📄 Semua Dokumen</h2>
            <p class="text-sm text-gray-500">
                Kelola dokumen UKM/Ormawa yang masuk dan pantau status persetujuannya
            </p>
        </div>

        <a href="{{ route('admin.dokumen.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm">
            <i class="fas fa-file-alt"></i>
            Lihat Semua
        </a>
    </div>

    <!-- Table Card -->
    <div class="overflow-hidden bg-white shadow-sm border border-gray-100 rounded-2xl">
        <!-- Table toolbar  -->
        <div class="flex flex-col gap-3 px-4 py-3 border-b border-gray-100 sm:flex-row sm:items-center sm:justify-between bg-gray-50/60">
            <div>
                <p class="text-sm font-semibold text-gray-800">Daftar dokumen</p>
                <p class="text-xs text-gray-500">
                    Menampilkan {{ $documents->firstItem() ?? 0 }}–{{ $documents->lastItem() ?? 0 }}
                    dari {{ $documents->total() }} dokumen
                </p>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="text-xs font-semibold uppercase tracking-wide bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Tipe</th>
                        <th class="px-4 py-3">UKM/Ormawa</th>
                        <th class="px-4 py-3">Proker</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Tanggal Upload</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($documents as $doc)
                        @php
                            $status = strtolower($doc->latestStatus->status ?? '');
                            $statusColor = match($status) {
                                'disetujui', 'approved' => 'bg-green-100 text-green-700',
                                'pending', 'menunggu', 'diproses' => 'bg-yellow-100 text-yellow-700',
                                'rejected', 'ditolak', 'revisi' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        @endphp
                        <tr class="hover:bg-gray-50/80 transition">
                            <td class="px-4 py-3 font-medium text-gray-900">
                                <div class="flex flex-col">
                                    <span class="line-clamp-1">{{ $doc->title }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex px-2.5 py-1 text-[11px] font-semibold rounded-full bg-blue-50 text-blue-700">
                                    {{ strtoupper($doc->document_type) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-sm font-semibold text-gray-800">
                                    {{ $doc->room->name }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-sm text-gray-700">
                                    {{ $doc->proker->nama_proker ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-semibold rounded-full {{ $statusColor }}">
                                    @if($status === 'disetujui' || $status === 'approved')
                                        <i class="mr-1 text-xs fas fa-check-circle"></i>
                                    @elseif(in_array($status, ['pending','menunggu','diproses']))
                                        <i class="mr-1 text-xs fas fa-hourglass-half"></i>
                                    @elseif(in_array($status, ['rejected','ditolak','revisi']))
                                        <i class="mr-1 text-xs fas fa-times-circle"></i>
                                    @else
                                        <i class="mr-1 text-xs fas fa-info-circle"></i>
                                    @endif
                                    {{ ucfirst($doc->latestStatus->status ?? 'Belum ada') }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700 whitespace-nowrap">
                                {{ $doc->submitted_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.dokumen.show', $doc->id) }}"
                                       class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-blue-700 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                                        <i class="fas fa-eye text-[11px]"></i>
                                        Lihat
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-sm text-center text-gray-500">
                                Belum ada dokumen yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-4 border-t border-gray-100 bg-gray-50/60">
            <div class="flex items-center justify-between text-xs text-gray-500">
                <span>
                    Menampilkan {{ $documents->firstItem() ?? 0 }}–{{ $documents->lastItem() ?? 0 }}
                    dari {{ $documents->total() }} dokumen
                </span>
                <div class="flex items-center">
                    {{ $documents->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
