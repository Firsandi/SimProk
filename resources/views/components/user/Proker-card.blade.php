<div class="p-4 bg-white shadow-sm rounded-xl md:p-6 card">
    <h4 class="mb-2 text-base font-bold text-gray-800 md:text-lg">{{ $proker->name }}</h4>
    <p class="mb-4 text-xs text-gray-600 md:text-sm">{{ $proker->description }}</p>

    <div class="flex flex-col gap-1 mb-4 text-xs text-gray-500 md:flex-row md:items-center md:justify-between md:text-sm">
        <span>Status: <span class="font-semibold">{{ ucfirst($proker->status) }}</span></span>
        <span>Dokumen: {{ $proker->documents->count() }}</span>
    </div>

    <div class="flex flex-col gap-2 md:flex-row">
        <a href="{{ route('user.rooms.show', $proker->room_id) }}" 
           class="flex-1 py-2 text-sm font-medium text-center text-white bg-teal-600 rounded-lg hover:bg-teal-700">
            Buka Room
        </a>
        <a href="{{ route('user.document.create', $proker->room_id) }}" 
           class="flex-1 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            Upload
        </a>
    </div>
</div>
