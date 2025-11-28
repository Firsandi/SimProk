<div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-{{ $color }}-500">
    <div class="flex items-center justify-between mb-4">
        <div class="w-12 h-12 bg-{{ $color }}-100 rounded-lg flex items-center justify-center">
            <i class="{{ $icon }} text-{{ $color }}-600 text-xl"></i>
        </div>
    </div>
    <p class="text-gray-600 text-sm mb-1">{{ $label }}</p>
    <p class="text-3xl font-bold text-gray-800">{{ $value }}</p>
</div>
