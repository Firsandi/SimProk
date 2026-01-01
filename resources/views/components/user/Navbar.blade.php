<header class="sticky top-0 z-40 bg-white shadow-sm">
    <div class="flex items-center justify-between px-4 py-3 md:px-6 md:py-4">
        <div class="flex items-center gap-3">
            {{-- Toggle sidebar mobile --}}
            <button id="userSidebarToggle"
                    class="p-2 text-gray-700 rounded-lg md:hidden hover:bg-gray-100">
                <i class="fas fa-bars"></i>
            </button>

            <div>
                <h2 class="text-lg font-bold text-gray-800 md:text-2xl">@yield('page-title')</h2>
                <p class="text-xs text-gray-600 md:text-sm">@yield('page-subtitle')</p>
            </div>
        </div>

        <div class="flex items-center gap-3 md:gap-4">
            <button class="relative p-2 text-gray-600 rounded-lg hover:bg-gray-100">
                <i class="text-lg md:text-xl fas fa-bell"></i>
            </button>
            <div class="flex items-center gap-2 md:gap-3">
                <div class="flex items-center justify-center text-sm font-bold text-white bg-teal-500 rounded-full w-9 h-9 md:w-10 md:h-10 md:text-base">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span class="hidden sm:block text-xs md:text-sm font-medium text-gray-700 max-w-[120px] truncate">
                    {{ auth()->user()->name }}
                </span>
            </div>
        </div>
    </div>
</header>
