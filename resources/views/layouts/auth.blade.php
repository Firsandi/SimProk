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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')

    <style>
        body { font-family: 'Plus Jakarta Sans', 'Inter', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="@yield('body-class', 'min-h-screen bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600') antialiased">
    
    <!-- Content will be injected here -->
    @yield('content')

    <!-- Scripts from child views -->
    @stack('scripts')
</body>
</html>
