<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      x-data="{ 
        darkMode: localStorage.getItem('dark-mode') === 'enabled', 
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('dark-mode', this.darkMode ? 'enabled' : 'disabled');
            document.documentElement.classList.toggle('dark', this.darkMode);
        }
      }" 
      x-init="
        document.documentElement.classList.toggle('dark', darkMode);
        $watch('darkMode', val => {
            localStorage.setItem('dark-mode', val ? 'enabled' : 'disabled');
            document.documentElement.classList.toggle('dark', val);
        })
      "
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        if (localStorage.getItem('dark-mode') === 'enabled') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <title>{{ config('app.name', 'DocTrack') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="icon" href="{{ asset('assets/img/doctracklogo.png') }}">
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden">
            {{ $slot }}
        </div>
    </div>
</body>
</html>