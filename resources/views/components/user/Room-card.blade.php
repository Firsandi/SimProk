<div class="p-6 transition bg-white shadow-sm rounded-xl hover:shadow-md">
    <h3 class="mb-2 text-lg font-bold text-gray-800">{{ $room->name }}</h3>
    <p class="mb-3 text-sm text-gray-600">{{ $room->period }}</p>

    <div class="flex flex-wrap gap-2 mb-4">
        <span class="px-3 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">
            {{ strtoupper($room->organization_type) }}
        </span>
        <span class="px-3 py-1 text-xs font-semibold text-teal-700 bg-teal-100 rounded-full">
            {{ ucfirst($room->status) }}
        </span>
    </div>

    <a href="{{ route('user.rooms.show', $room->id) }}"
       class="inline-block px-4 py-2 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700">
        Lihat Detail
    </a>
</div>
