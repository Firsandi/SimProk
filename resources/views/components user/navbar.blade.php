<div>
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
</div>
<header class="bg-white shadow-sm h-20 flex items-center px-6 border-b border-gray-200">
    <div class="flex items-center justify-between w-full">
        
        <!-- Left: Mobile Toggle & Page Title -->
        <div class="flex items-center space-x-4">
            <button id="toggleSidebar" class="md:hidden p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-bars text-xl text-gray-700"></i>
            </button>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                <p class="text-sm text-gray-500 mt-1">@yield('page-subtitle', 'Kelola dokumen dan program kerja Anda')</p>
            </div>
        </div>
        
        <!-- Right: Notifications & User Profile -->
        <div class="flex items-center space-x-6">
            
            <!-- Notification Button -->
            <a href="{{ route('user.notifications') }}" class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-bell text-xl"></i>
                <span id="notifDot" class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full hidden"></span>
            </a>
            
            <!-- User Dropdown -->
            <div class="flex items-center space-x-3 pl-6 border-l border-gray-200">
                <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'User' }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                </div>
            </div>
            
        </div>
        
    </div>
</header>

<script>
    // Toggle Sidebar for Mobile
    document.getElementById('toggleSidebar')?.addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
    });
    
    // Update Notification Badge
    function updateNotificationBadge() {
        fetch('{{ route('user.notifications.unread-count') }}')
            .then(r => r.json())
            .then(data => {
                const badge = document.getElementById('notifBadge');
                const dot = document.getElementById('notifDot');
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.classList.remove('hidden');
                    dot.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                    dot.classList.add('hidden');
                }
            });
    }
    
    // Update on page load and every 30 seconds
    updateNotificationBadge();
    setInterval(updateNotificationBadge, 30000);
</script>
