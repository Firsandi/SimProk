<header class="sticky top-0 z-40 bg-white shadow-sm">
    <div class="flex items-center justify-between px-6 py-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">@yield('page-title')</h2>
            <p class="text-sm text-gray-600">@yield('page-subtitle')</p>
        </div>
        <div class="flex items-center gap-4">
            <button class="relative p-2 text-gray-600 rounded-lg hover:bg-gray-100">
                <i class="text-xl fas fa-bell"></i>
            </button>
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 font-bold text-white bg-teal-500 rounded-full">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span class="hidden text-sm font-medium text-gray-700 md:block">{{ auth()->user()->name }}</span>
            </div>
        </div>
    </div>
</header>
