<header class="sticky top-0 z-40 flex items-center justify-between px-6 py-4 bg-white shadow-md">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">{{ $title ?? 'Dashboard' }}</h2>
        <p class="text-sm text-gray-600">{{ $subtitle ?? 'Kelola semua UKM dan Ormawa' }}</p>
    </div>
    <div class="flex items-center gap-4">
        <!-- Date -->
        <div class="items-center hidden gap-2 px-4 py-2 bg-gray-100 rounded-lg md:flex">
            <i class="text-gray-600 fas fa-calendar"></i>
            <span class="text-sm font-semibold text-gray-700">{{ now()->translatedFormat('d F Y') }}</span>
        </div>
        
        <!-- Profile -->
        <div class="flex items-center gap-3">
            <div class="flex items-center justify-center w-10 h-10 font-bold text-blue-600 bg-blue-100 rounded-full">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="hidden md:block">
                <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500">Administrator</p>
            </div>
        </div>
    </div>
</header>
