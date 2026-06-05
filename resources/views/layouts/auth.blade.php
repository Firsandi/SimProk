<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SimProk - Authentication')</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Tailwind CSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Axios CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';</script>

    @stack('styles')

    {{-- Custom Design System CSS --}}
    <style>
        body { font-family: 'Plus Jakarta Sans', 'Inter', ui-sans-serif, system-ui, sans-serif; }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(148, 163, 184, 0.4); border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(148, 163, 184, 0.7); }

        html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }

        @keyframes shimmer { 0% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }
        @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fade-in-up { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slide-in-left { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-6px); } }
        @keyframes pulse-soft { 0%, 100% { opacity: 0.6; } 50% { opacity: 1; } }
        @keyframes gradient-shift { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }

        .animate-shimmer { animation: shimmer 2s infinite; }
        .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
        .animate-fade-in-up { animation: fade-in-up 0.5s ease-out forwards; }
        .animate-slide-in-left { animation: slide-in-left 0.4s ease-out forwards; }
        .animate-float { animation: float 4s ease-in-out infinite; }
        .animate-pulse-soft { animation: pulse-soft 3s ease-in-out infinite; }
        .animate-gradient { background-size: 200% 200%; animation: gradient-shift 6s ease infinite; }

        .stagger-1 { animation-delay: 0.05s; } .stagger-2 { animation-delay: 0.1s; }
        .stagger-3 { animation-delay: 0.15s; } .stagger-4 { animation-delay: 0.2s; }

        .glass { background: rgba(255,255,255,0.7); backdrop-filter: blur(12px) saturate(180%); -webkit-backdrop-filter: blur(12px) saturate(180%); }
        .glass-dark { background: rgba(15,23,42,0.85); backdrop-filter: blur(16px) saturate(200%); -webkit-backdrop-filter: blur(16px) saturate(200%); }
    </style>
</head>
<body class="@yield('body-class', 'min-h-screen bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600') antialiased">
    
    <!-- Content will be injected here -->
    @yield('content')

    <!-- Scripts from child views -->
    @stack('scripts')
</body>
</html>
