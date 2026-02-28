<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      x-data="{ 
        darkMode: localStorage.getItem('dark-mode') === 'enabled', 
        sidebarOpen: true,
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('dark-mode', this.darkMode ? 'enabled' : 'disabled');
        }
      }" 
      x-init="
        $watch('darkMode', val => {
            localStorage.setItem('dark-mode', val ? 'enabled' : 'disabled');
        })
      "
      :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script>
        // Inline script to prevent theme flashing
        if (localStorage.getItem('dark-mode') === 'enabled') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <title>{{ $title ?? config('app.name', 'DocTrack') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <link rel="icon" href="{{ asset('assets/img/doctracklogo.png') }}">
    
    <style>
        html, body {
            height: 100vh !important;
            height: -webkit-fill-available !important; /* Mobile browser support */
            width: 100vw !important;
            overflow: hidden !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        #app-root {
            height: 100vh !important;
            height: -webkit-fill-available !important;
        }
        .sidebar-transition {
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
    </style>

    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-500" 
      :class="{ 'dark': darkMode }">
    <div id="app-root" class="flex overflow-hidden">
        <!-- Sidebar -->
        <x-layouts.sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-full overflow-hidden">
            <!-- Top Bar -->
            <x-layouts.top-bar :userName="$userName" />

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-gray-900 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
