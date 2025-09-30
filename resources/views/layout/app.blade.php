<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'CareerBridge - Find Your Dream Career')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700,800" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="font-sans antialiased" style="background-color: var(--bg-light); color: var(--text-dark);">
    <div class="min-h-screen">
        <!-- Navigation -->
        @include('inc.nav')
        
        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
        
        <!-- Footer -->
        @include('inc.footer')
    </div>
    
    @stack('scripts')
    
    <!-- Additional script to ensure all scripts run -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('App layout DOM loaded');
        });
    </script>
</body>
</html>