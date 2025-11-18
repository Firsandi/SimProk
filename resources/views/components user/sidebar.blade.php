<div>
    <!-- Simplicity is an acquired taste. - Katharine Gerould -->
</div>
<aside class="w-64 bg-gradient-to-b from-blue-700 to-blue-900 text-white flex-shrink-0">
    <div class="flex flex-col h-full">
        
        <!-- Logo -->
        <div class="flex items-center justify-center h-20 border-b border-blue-600">
            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                <span class="text-blue-700 font-bold text-lg">SP</span>
            </div>
            <h1 class="ml-3 text-xl font-bold">SimProk</h1>
        </div>
        
        <!-- User Info -->
        <div class="px-4 py-6 border-b border-blue-600">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-full bg-blue-300 flex items-center justify-center text-blue-900 font-bold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold">{{ auth()->user()->name ?? 'User' }}</p>
                    <p class="text-xs text-blue-200">{{ ucfirst(auth()->user()->role ?? 'anggota') }}</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('user.dashboard') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('user.dashboard') ? 'bg-white bg-opacity-20 text-white border-l-4 border-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10' }}">
                <i class="fas fa-home w-5"></i>
                <span class="ml-3 font-medium">Dashboard</span>
            </a>
            
            <a href="{{ route('user.documents') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('user.documents') ? 'bg-white bg-opacity-20 text-white border-l-4 border-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10' }}">
                <i class="fas fa-file-alt w-5"></i>
                <span class="ml-3 font-medium">Dokumen Saya</span>
            </a>
            
            <a href="{{ route('user.rooms') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('user.rooms') || request()->routeIs('user.room.detail') ? 'bg-white bg-opacity-20 text-white border-l-4 border-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10' }}">
                <i class="fas fa-door-open w-5"></i>
                <span class="ml-3 font-medium">Room Saya</span>
            </a>
            
            <a href="{{ route('user.notifications') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-colors relative {{ request()->routeIs('user.notifications') ? 'bg-white bg-opacity-20 text-white border-l-4 border-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10' }}">
                <i class="fas fa-bell w-5"></i>
                <span class="ml-3 font-medium">Notifikasi</span>
                <span id="notifBadge" class="absolute right-3 w-5 h-5 bg-red-500 rounded-full text-xs flex items-center justify-center hidden">0</span>
            </a>
            
            <a href="{{ route('user.timeline') }}" 
               class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('user.timeline') ? 'bg-white bg-opacity-20 text-white border-l-4 border-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10' }}">
                <i class="fas fa-clock w-5"></i>
                <span class="ml-3 font-medium">Timeline</span>
            </a>
        </nav>
        
        <!-- Profile & Logout -->
        <div class="border-t border-blue-600 px-4 py-4 space-y-2">
            <a href="{{ route('user.profile') }}" 
               class="flex items-center px-4 py-3 rounded-lg text-blue-100 hover:bg-white hover:bg-opacity-10 transition-colors">
                <i class="fas fa-user-circle w-5"></i>
                <span class="ml-3 font-medium">Profile</span>
            </a>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span class="text-sm font-medium">Logout</span>
                </button>
            </form>
        </div>
        
    </div>
</aside>
