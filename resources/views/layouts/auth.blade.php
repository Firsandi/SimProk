<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SimProk - Authentication')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body class="@yield('body-class', 'min-h-screen bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600')">
    
    <!-- Content will be injected here -->
    @yield('content')

    <!-- Scripts from child views -->
    @stack('scripts')
</body>
</html>
