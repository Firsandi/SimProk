{{-- Admin Sidebar — Premium Dark Glass --}}
<div class="admin-sidebar fixed inset-y-0 left-0 z-50 flex flex-col justify-between w-64 h-screen text-white transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 border-r border-white/5">

    {{-- Header + Close Button --}}
    <div>
        <div class="p-5 md:p-6 border-b border-white/10">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    {{-- Logo Icon --}}
                    <div class="flex items-center justify-center w-10 h-10 md:w-11 md:h-11 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg shadow-blue-500/25">
                        <i class="text-lg md:text-xl text-white fas fa-crown"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-extrabold tracking-tight text-white">SimProk</h1>
                        <p class="text-[10px] md:text-xs font-medium text-slate-400">Admin Panel</p>
                    </div>
                </div>

                {{-- Mobile close --}}
                <button id="adminSidebarClose"
                        class="p-2 text-slate-400 rounded-lg md:hidden hover:bg-white/10 hover:text-white transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="p-4 space-y-1.5 text-sm">
            <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-widest text-slate-500">Menu Utama</p>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('admin.dashboard')
                        ? 'bg-gradient-to-r from-blue-600/90 to-indigo-600/90 text-white shadow-lg shadow-blue-500/20 font-semibold'
                        : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <i class="text-base fas fa-home w-5 text-center"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="{{ route('admin.dokumen.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('admin.dokumen.*')
                        ? 'bg-gradient-to-r from-blue-600/90 to-indigo-600/90 text-white shadow-lg shadow-blue-500/20 font-semibold'
                        : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <i class="text-base fas fa-file-alt w-5 text-center"></i>
                <span class="font-medium">Dokumen</span>
            </a>

            <a href="{{ route('admin.room.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('admin.room.*')
                        ? 'bg-gradient-to-r from-blue-600/90 to-indigo-600/90 text-white shadow-lg shadow-blue-500/20 font-semibold'
                        : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <i class="text-base fas fa-building w-5 text-center"></i>
                <span class="font-medium">Kelola Room</span>
            </a>
        </nav>
    </div>

    {{-- User Card & Logout --}}
    <div class="border-t border-white/10">
        {{-- User Info --}}
        <div class="p-4">
            <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5">
                <div class="flex items-center justify-center w-10 h-10 font-bold text-white rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-sm shadow-md">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-slate-400">Administrator</p>
                </div>
            </div>
        </div>

        {{-- Logout --}}
        <div class="px-4 pb-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="flex items-center justify-center w-full gap-2 px-4 py-2.5 text-sm font-semibold text-red-300 transition-all duration-200 rounded-xl border border-red-500/20 bg-red-500/10 hover:bg-red-500/20 hover:text-red-200">
                    <i class="fas fa-sign-out-alt text-xs"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>
