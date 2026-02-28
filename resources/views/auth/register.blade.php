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
    
    <title>Sign Up - DoTrack</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="icon" href="{{ asset('assets/img/doctracklogo.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="font-sans antialiased bg-indigo-50 dark:bg-indigo-950 transition-colors duration-300">
    <div class="min-h-screen flex flex-col justify-center items-center py-12 relative overflow-hidden">
        <div class="w-full sm:max-w-2xl px-10 py-12 bg-white dark:bg-gray-900 shadow-2xl overflow-hidden sm:rounded-3xl border border-indigo-100 dark:border-indigo-900 transition-all">
            <div class="flex flex-col items-center mb-10">
                <a href="{{ route('login') }}" class="mb-4">
                    <x-application-logo height="h-16">
                        <img src="{{ asset('assets/img/doctracklogo.png') }}" class="h-full w-auto dark:hidden" alt="Logo">
                        <img src="{{ asset('assets/img/whitelogo.png') }}" class="h-full w-auto hidden dark:block" alt="Logo">
                    </x-application-logo>
                </a>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Create Account</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm italic font-medium">It's quick and easy.</p>
            </div>

            <form method="POST" action="{{ route('register.store') }}" class="space-y-8">
                @csrf

                <!-- Name Section -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2 pb-1 border-b border-gray-100 dark:border-gray-700">
                        <span class="material-symbols-outlined text-indigo-500 text-sm">person</span>
                        <h2 class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Personal Information</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label for="firstName" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight ml-1">First Name</label>
                            <input id="firstName" type="text" name="firstname" value="{{ old('firstname') }}" required autofocus 
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200">
                        </div>
                        <div class="space-y-1">
                            <label for="lastName" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight ml-1">Last Name</label>
                            <input id="lastName" type="text" name="lastname" value="{{ old('lastname') }}" required
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200">
                        </div>
                    </div>
                </div>

                <!-- Account Credentials -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2 pb-1 border-b border-gray-100 dark:border-gray-700">
                        <span class="material-symbols-outlined text-indigo-500 text-sm">lock</span>
                        <h2 class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Account Credentials</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1 md:col-span-2">
                            <label for="Email" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight ml-1">Email Address</label>
                            <input id="Email" type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200">
                        </div>
                        <div class="space-y-1 md:col-span-2">
                            <label for="Username" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight ml-1">Username</label>
                            <input id="Username" type="text" name="username" value="{{ old('username') }}" required
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200">
                        </div>
                        <div class="space-y-1">
                            <label for="Password" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight ml-1">Password</label>
                            <input id="Password" type="password" name="password" required
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200">
                        </div>
                        <div class="space-y-1">
                            <label for="password_confirmation" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight ml-1">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200">
                        </div>
                    </div>
                </div>

                <!-- Birthday & Gender -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2 pb-1 border-b border-gray-100 dark:border-gray-700">
                        <span class="material-symbols-outlined text-indigo-500 text-sm">calendar_month</span>
                        <h2 class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Additional Details</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight ml-1">Birthday</label>
                            <div class="flex space-x-2">
                                <select name="month" required class="flex-1 bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-xs focus:ring-indigo-500 dark:text-gray-300">
                                    <option disabled selected>Month</option>
                                    @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                        <option value="{{ $month }}" {{ old('month') == $month ? 'selected' : '' }}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                <select name="day" required class="w-20 bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-xs focus:ring-indigo-500 dark:text-gray-300">
                                    <option disabled selected>Day</option>
                                    @for($day = 1; $day <= 31; $day++)
                                        <option value="{{ $day }}" {{ old('day') == $day ? 'selected' : '' }}>{{ $day }}</option>
                                    @endfor
                                </select>
                                <select name="year" required class="w-24 bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-xs focus:ring-indigo-500 dark:text-gray-300">
                                    <option disabled selected>Year</option>
                                    @for($year = date('Y'); $year >= 1960; $year--)
                                        <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label for="gender" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight ml-1">Gender</label>
                            <select name="gender" id="gender" required class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-indigo-500 transition-all dark:text-gray-200">
                                <option disabled selected>Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Rather not to say" {{ old('gender') == 'Rather not to say' ? 'selected' : '' }}>Rather not to say</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="pt-6 space-y-6">
                    <p class="text-[10px] text-gray-500 text-center leading-relaxed">
                        By clicking Sign Up, you agree to our <a href="#" class="text-indigo-600 font-bold hover:underline">Terms</a>, 
                        <a href="#" class="text-indigo-600 font-bold hover:underline">Privacy Policy</a> and 
                        <a href="#" class="text-indigo-600 font-bold hover:underline">Cookies Policy</a>.
                    </p>
                    
                    <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl text-sm font-bold shadow-lg shadow-indigo-200 dark:shadow-none transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                        Create My Account
                    </button>

                    <div class="text-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 hover:underline transition-colors">Sign in instead</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Registration Error',
                text: '{{ $errors->first() }}',
                confirmButtonColor: '#4f46e5',
                customClass: {
                    popup: 'rounded-3xl',
                    confirmButton: 'rounded-xl px-6 py-2.5 font-bold'
                }
            });
        @endif
    </script>
</body>

</html>
