<header class="sticky top-0 z-40 flex items-center justify-between px-4 py-3 bg-white shadow-md md:px-6 md:py-4">
    <div class="flex items-center gap-3">
        {{-- Tombol toggle sidebar (mobile) --}}
        <button id="adminSidebarToggle"
                class="p-2 text-gray-700 rounded-lg md:hidden hover:bg-gray-100">
            <i class="fas fa-bars"></i>
        </button>

        <div>
            <h2 class="text-lg font-bold text-gray-900 md:text-2xl">
                {{ $title ?? 'Dashboard' }}
            </h2>
            <p class="text-xs text-gray-600 md:text-sm">
                {{ $subtitle ?? 'Kelola semua UKM dan Ormawa' }}
            </p>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <div class="items-center hidden gap-2 px-4 py-2 bg-gray-100 rounded-lg md:flex">
            <i class="text-gray-600 fas fa-calendar"></i>
            <span class="text-sm font-semibold text-gray-700">
                {{ now()->translatedFormat('d F Y') }}
            </span>
        </div>

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
