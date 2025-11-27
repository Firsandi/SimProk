<div class="bg-white rounded-xl p-6 shadow-sm card">
    <h4 class="text-lg font-bold text-gray-800 mb-2">{{ $proker->name }}</h4>
    <p class="text-sm text-gray-600 mb-4">{{ $proker->description }}</p>

    <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
        <span>Status: <span class="font-semibold">{{ ucfirst($proker->status) }}</span></span>
        <span>Dokumen: {{ $proker->documents->count() }}</span>
    </div>

    <div class="flex gap-2">
        <a href="{{ route('user.rooms.show', $proker->room_id) }}" 
           class="flex-1 bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-lg font-medium text-sm text-center">
            Buka Room
        </a>
        <a href="{{ route('user.document.create', $proker->room_id) }}" 
           class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium text-sm text-center">
            Upload
        </a>
    </div>
</div>
