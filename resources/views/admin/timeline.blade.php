@extends('layouts.admin')

@section('title', 'Timeline Admin')
@section('page-title', 'Timeline')
@section('page-subtitle', 'Riwayat aktivitas dokumen dan perubahan status')

@section('content')

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6">
        <div class="flex flex-col md:flex-row items-center gap-4">
            <div class="flex-1">
                <input type="text" 
                       id="searchInput"
                       placeholder="Cari aktivitas..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Status</option>
                <option value="approved">Disetujui</option>
                <option value="pending">Menunggu Review</option>
                <option value="revision">Revisi</option>
            </select>
        </div>
    </div>

    <!-- Timeline Content -->
    <div class="bg-white rounded-xl shadow-md p-6">
        
        <h3 class="text-xl font-bold text-gray-800 mb-6">Aktivitas Terkini</h3>
        
        <!-- Timeline Items -->
        <div class="space-y-6">
            @forelse($timeline_items as $item)
            <!-- Timeline Item -->
            <div class="flex gap-4 timeline-item" data-status="{{ $item['status_type'] ?? '' }}">
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 bg-{{ $item['color'] }}-500 rounded-full flex items-center justify-center text-white">
                        <i class="fas fa-{{ $item['icon'] }}"></i>
                    </div>
                    @if(!$loop->last)
                    <div class="w-0.5 h-full bg-gray-200 mt-2"></div>
                    @endif
                </div>
                <div class="flex-1 pb-6">
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex items-start justify-between mb-2">
                            <h4 class="font-bold text-gray-800">{{ $item['title'] }}</h4>
                            <span class="text-xs text-gray-500">{{ $item['timestamp'] }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">
                            {!! $item['description'] !!}
                        </p>
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 bg-{{ $item['color'] }}-100 text-{{ $item['color'] }}-700 text-xs font-semibold rounded-full">
                                {{ $item['status'] }}
                            </span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                                {{ $item['organization'] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-4xl text-gray-400"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Aktivitas</h4>
                <p class="text-gray-600">Timeline aktivitas akan muncul di sini</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($timelines->hasPages())
        <div class="mt-6">
            {{ $timelines->links() }}
        </div>
        @endif
        
    </div>

@endsection

@push('scripts')
<script>
    // Opsional: Filtering JS jika mau filter client-side.
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const timelineItems = document.querySelectorAll('.timeline-item');

        function filterTimeline() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusValue = statusFilter.value.toLowerCase();

            timelineItems.forEach(item => {
                const itemText = item.textContent.toLowerCase();
                const itemStatus = item.dataset.status ? item.dataset.status.toLowerCase() : '';
                const matchesSearch = itemText.includes(searchTerm);
                const matchesStatus = !statusValue || itemStatus === statusValue;

                if (matchesSearch && matchesStatus) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterTimeline);
        statusFilter.addEventListener('change', filterTimeline);
    });
</script>
@endpush
