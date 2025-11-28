<div class="fixed top-0 left-0 z-50 w-64 h-screen overflow-y-auto text-white bg-gray-900 sidebar">
    <div class="p-6">
        <div class="flex items-center gap-3 mb-8">
            <div class="flex items-center justify-center w-10 h-10 bg-blue-500 rounded-lg">
                <i class="text-xl text-white fas fa-folder-open"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold text-white">SimProk</h1>
                <p class="text-xs text-gray-400">User Dashboard</p>
            </div>
        </div>
        <div class="pb-6 mb-6 border-b border-gray-700">
            <div class="flex items-center gap-3 mb-2">
                <div class="flex items-center justify-center w-12 h-12 text-lg font-bold text-white bg-teal-500 rounded-full">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400">Mahasiswa HMIF</p>
                </div>
            </div>
        </div>
        <nav class="mb-8 space-y-2">
            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-white rounded-lg menu-item active">
                <i class="fas fa-home"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('user.myprokers') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 rounded-lg menu-item">
                <i class="fas fa-briefcase"></i><span>My Prokers</span>
            </a>
            <a href="{{ route('user.documents') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 rounded-lg menu-item">
                <i class="fas fa-file-alt"></i><span>Documents</span>
            </a>
            <a href="{{ route('user.notifications') }}" class="relative flex items-center gap-3 px-4 py-3 text-gray-300 rounded-lg menu-item">
                <i class="fas fa-bell"></i><span>Notifications</span>
            </a>
            <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 rounded-lg menu-item">
                <i class="fas fa-user"></i><span>Profile</span>
            </a>
        </nav>
    </div>
    <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-gray-700">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 btn">
                <i class="mr-2 fas fa-sign-out-alt"></i>Logout
            </button>
        </form>
    </div>
</div>
