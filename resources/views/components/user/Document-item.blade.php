<div class="p-4 flex justify-between items-center">
    <div>
        <p class="font-medium text-gray-800">{{ $document->title }}</p>
        <p class="text-xs text-gray-500">
            {{ ucfirst($document->document_type) }} • {{ $document->submitted_at->format('d M Y') }}
        </p>
    </div>
    <span class="text-xs px-2 py-1 rounded-full font-semibold
        @if($document->status == 'pending') bg-yellow-100 text-yellow-700
        @elseif($document->status == 'approved') bg-green-100 text-green-700
        @elseif($document->status == 'rejected') bg-red-100 text-red-700
        @else bg-gray-100 text-gray-700
        @endif">
        {{ ucfirst($document->status) }}
    </span>
</div>
