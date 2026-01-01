<div class="bg-white rounded-xl p-4 md:p-6 shadow-sm border-l-4 border-{{ $color }}-500">
    <div class="flex items-center justify-between mb-4">
        <div class="w-10 h-10 md:w-12 md:h-12 bg-{{ $color }}-100 rounded-lg flex items-center justify-center">
            <i class="{{ $icon }} text-{{ $color }}-600 text-lg md:text-xl"></i>
        </div>
    </div>
    <p class="mb-1 text-xs text-gray-600 md:text-sm">{{ $label }}</p>
    <p class="text-2xl font-bold text-gray-800 md:text-3xl">{{ $value }}</p>
</div>
