<div class="fixed top-0 left-0 z-50 flex flex-col justify-between w-64 h-screen text-white bg-gray-900">

    <!-- Header -->
    <div>
        <div class="p-6 border-b border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-12 h-12 bg-blue-500 rounded-lg">
                    <i class="text-2xl text-white fas fa-crown"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">SimProk</h1>
                    <p class="text-xs text-gray-400">Admin Dashboard</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="p-4 space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <i class="text-lg fas fa-home"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <!-- Dokumen -->
            <a href="{{ route('admin.dokumen.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.dokumen') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <i class="text-lg fas fa-file"></i>
                <span class="font-medium">Dokumen</span>
            </a>

            <!-- Kelola Room -->
            <a href="{{ route('admin.room.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.room.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <i class="text-lg fas fa-building"></i>
                <span class="font-medium">Kelola Room</span>
            </a>
        </nav>
    </div>

    <!-- User Info & Logout -->
    <div class="border-t border-gray-800">
        <!-- User Profile -->
        <div class="p-4 border-b border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 font-bold text-white bg-blue-600 rounded-full">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400">Administrator</p>
                </div>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="p-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="flex items-center justify-center w-full gap-2 px-4 py-3 font-semibold text-white transition bg-red-600 rounded-lg shadow-md hover:bg-red-700 hover:shadow-lg">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

</div>
