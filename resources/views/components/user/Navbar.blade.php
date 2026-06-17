<header class="sticky top-0 z-40 flex items-center justify-between px-4 py-3 bg-white/70 backdrop-blur-xl shadow-[0_4px_30px_rgba(0,0,0,0.03)] border-b border-white/20 md:px-6 md:py-4 transition-all duration-300">
    <div class="flex items-center gap-4">
        {{-- Toggle sidebar mobile --}}
        <button id="userSidebarToggle"
                class="flex items-center justify-center w-10 h-10 text-slate-600 transition-all duration-200 bg-white border border-slate-200 rounded-xl md:hidden hover:bg-slate-50 hover:text-teal-600 focus:ring-2 focus:ring-teal-500/20 shadow-sm">
            <i class="fas fa-bars"></i>
        </button>

        <div>
            <h2 class="text-xl font-extrabold tracking-tight text-slate-800 md:text-2xl bg-clip-text text-transparent bg-gradient-to-r from-slate-800 to-slate-500">
                @yield('page-title', 'Dashboard')
            </h2>
            <p class="text-xs font-medium text-slate-500 md:text-sm mt-0.5">
                @yield('page-subtitle', 'Sistem Informasi Program Kerja')
            </p>
        </div>
    </div>

    <div class="flex items-center gap-4 md:gap-5">
        <button class="relative flex items-center justify-center w-10 h-10 text-slate-500 transition-all duration-300 bg-slate-50 border border-slate-200 rounded-xl hover:bg-teal-50 hover:text-teal-600 hover:border-teal-200 group">
            <i class="text-lg md:text-xl fas fa-bell group-hover:animate-pulse-soft"></i>
            <span class="absolute top-2 right-2.5 w-2 h-2 bg-rose-500 rounded-full ring-2 ring-white"></span>
        </button>
        
        <div class="flex items-center gap-3 pl-2 md:pl-4 md:border-l border-slate-200">
            <div class="flex items-center justify-center w-10 h-10 md:w-11 md:h-11 font-bold text-white bg-gradient-to-br from-teal-400 to-emerald-600 rounded-xl shadow-lg shadow-teal-500/20 ring-2 ring-white transform hover:scale-105 transition-all duration-300 cursor-pointer">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-bold text-slate-800 max-w-[120px] truncate">{{ auth()->user()->name ?? 'User Name' }}</p>
                <p class="text-[11px] font-semibold tracking-wider text-teal-600 uppercase">{{ auth()->user()->role ?? 'User' }}</p>
            </div>
        </div>
    </div>
</header>
