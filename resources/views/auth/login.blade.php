<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('dark-mode') === 'enabled' }" :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script>
        if (localStorage.getItem('dark-mode') === 'enabled') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <title>Log In - DocTrack</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="icon" href="{{ asset('assets/img/doctracklogo.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="font-sans antialiased bg-indigo-50 dark:bg-indigo-950 transition-colors duration-300 overflow-hidden">
    <div class="min-h-screen flex flex-col justify-center items-center py-12 relative">
        <div class="w-full sm:max-w-md px-8 py-10 bg-white dark:bg-gray-900 shadow-2xl overflow-hidden sm:rounded-3xl border border-indigo-100 dark:border-indigo-900 transition-all" 
             x-data="{ showPassword: false }">
            
            <div class="flex flex-col items-center mb-8">
                <a href="/" class="mb-4">
                    <x-application-logo height="h-16">
                        <img src="{{ asset('assets/img/doctracklogo.png') }}" class="h-16 w-auto dark:hidden" alt="Logo">
                        <img src="{{ asset('assets/img/whitelogo.png') }}" class="h-16 w-auto hidden dark:block" alt="Logo">
                    </x-application-logo>
                </a>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Welcome Back</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm italic font-medium">Please sign in to your account.</p>
            </div>

            <form method="POST" action="{{ route('login.store') }}" class="space-y-6">
                @csrf

                <!-- Username/Email -->
                <div class="space-y-1">
                    <label for="username" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight ml-1">Username or Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-gray-400">
                            <span class="material-symbols-outlined text-lg">person</span>
                        </div>
                        <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username"
                               class="w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200 placeholder:text-gray-400"
                               placeholder="Enter your username">
                    </div>
                    @error('username')
                        <span class="text-red-500 text-xs mt-1 ml-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-1">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight ml-1">Password</label>
                        @if (Route::has('password.request'))
                            <a class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline" href="{{ route('password.request') }}">
                                Forgot?
                            </a>
                        @endif
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-gray-400">
                            <span class="material-symbols-outlined text-lg">lock</span>
                        </div>
                        <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required autocomplete="current-password"
                               class="w-full pl-11 pr-11 py-3.5 bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200 placeholder:text-gray-400"
                               placeholder="••••••••">
                        <button type="button" @click="showPassword = !showPassword" 
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-indigo-500 transition-colors">
                            <span class="material-symbols-outlined text-lg" x-text="showPassword ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-red-500 text-xs mt-1 ml-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded-md border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-900 transition-all cursor-pointer" name="remember">
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400 group-hover:text-indigo-500 transition-colors">Remember me</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl text-sm font-bold shadow-lg shadow-indigo-200 dark:shadow-none transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                        Sign In
                    </button>
                </div>

                <div class="text-center space-y-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 hover:underline transition-colors">Create account</a>
                    </p>
                    <a href="/" class="inline-flex items-center text-xs font-semibold text-gray-400 dark:text-gray-500 hover:text-indigo-500 dark:hover:text-indigo-400 transition-colors">
                        <span class="material-symbols-outlined text-sm mr-1">arrow_back</span>
                        Back to home
                    </a>
                </div>
            </form>
        </div>
    </div>

    @if(Session::has('error'))
        <script>
            const isDark = localStorage.getItem('dark-mode') === 'enabled';
            Swal.fire({
                icon: 'error',
                title: 'Authentication Failed',
                text: 'Please check your credentials and try again.',
                confirmButtonColor: '#4f46e5',
                background: isDark ? '#1f2937' : '#fff',
                color: isDark ? '#fff' : '#1f2937',
                customClass: {
                    popup: 'rounded-3xl',
                    confirmButton: 'rounded-xl px-6 py-2.5 font-bold'
                }
            });
        </script>
    @endif
</body>

</html>
