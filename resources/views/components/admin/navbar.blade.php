<header class="sticky top-0 z-40 flex items-center justify-between px-4 py-3 bg-white/70 backdrop-blur-xl shadow-[0_4px_30px_rgba(0,0,0,0.03)] border-b border-white/20 md:px-6 md:py-4 transition-all duration-300">
    <div class="flex items-center gap-4">
        {{-- Tombol toggle sidebar (mobile) --}}
        <button id="adminSidebarToggle"
                class="flex items-center justify-center w-10 h-10 text-slate-600 transition-all duration-200 bg-white border border-slate-200 rounded-xl md:hidden hover:bg-slate-50 hover:text-blue-600 focus:ring-2 focus:ring-blue-500/20 shadow-sm">
            <i class="fas fa-bars"></i>
        </button>

        <div>
            <h2 class="text-xl font-extrabold tracking-tight text-slate-800 md:text-2xl bg-clip-text text-transparent bg-gradient-to-r from-slate-800 to-slate-500">
                {{ $title ?? 'Dashboard' }}
            </h2>
            <p class="text-xs font-medium text-slate-500 md:text-sm mt-0.5">
                {{ $subtitle ?? 'Kelola semua UKM dan Ormawa' }}
            </p>
        </div>
    </div>

    <div class="flex items-center gap-4 md:gap-5">
        <div class="items-center hidden gap-2.5 px-4 py-2 bg-gradient-to-br from-blue-50 to-indigo-50/50 border border-blue-100/50 rounded-xl md:flex shadow-[inset_0_1px_2px_rgba(255,255,255,0.8)]">
            <i class="text-blue-500 fas fa-calendar-alt"></i>
            <span class="text-sm font-bold text-blue-900 tracking-wide">
                {{ now()->translatedFormat('d F Y') }}
            </span>
        </div>

        <div class="flex items-center gap-3 pl-2 md:pl-4 md:border-l border-slate-200">
            <div class="flex items-center justify-center w-10 h-10 md:w-11 md:h-11 font-bold text-white bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg shadow-blue-500/20 ring-2 ring-white transform hover:scale-105 transition-all duration-300 cursor-pointer">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="hidden md:block">
                <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                <p class="text-[11px] font-semibold tracking-wider text-blue-600 uppercase">{{ auth()->user()->role ?? 'Administrator' }}</p>
            </div>
        </div>
    </div>
</header>
