@props(['userName'])

<header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 h-16 flex items-center justify-between px-6 transition-colors duration-300">
    <div class="flex items-center space-x-3">
        <!-- Sidebar Toggle -->
        <button x-on:click="sidebarOpen = !sidebarOpen; console.log('Sidebar Toggled:', sidebarOpen)" class="text-gray-500 hover:text-indigo-600 transition-colors duration-200 p-1 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
            <span class="material-symbols-outlined text-2xl">menu</span>
        </button>

        <!-- Logo -->
        <a href="{{ Auth::user()->usertype == 1 ? route('admin.home') : route('employee.home') }}" class="flex items-center space-x-2">
            <img src="{{ asset('assets/img/doctracklogo.png') }}" class="h-10 w-auto dark:hidden" alt="DocTrack Logo">
            <img src="{{ asset('assets/img/whitelogo.png') }}" class="h-10 w-auto hidden dark:block" alt="DocTrack Logo">
            <span class="text-xl font-bold text-gray-900 dark:text-white">DocTrack</span>
        </a>
    </div>

    <div class="user-actions flex items-center space-x-2 sm:space-x-4 ms-auto">
        <!-- Search Bar -->
        <div class="hidden md:flex items-center relative group mr-2">
            <span class="material-symbols-outlined absolute left-3 text-gray-400 group-focus-within:text-indigo-500 transition-colors">search</span>
            <input type="text" 
                   placeholder="Search documents..." 
                   class="bg-gray-100 dark:bg-gray-700 border-none rounded-full py-1.5 pl-10 pr-4 text-sm w-48 xl:w-64 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 transition-all duration-200 dark:text-gray-200">
        </div>

        <!-- Dark Mode Toggle -->
        <div class="flex items-center">
            <button x-on:click="toggleDarkMode(); console.log('Dark Mode:', darkMode)" 
                    class="text-gray-500 hover:text-amber-500 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                <span x-show="!darkMode" class="material-symbols-outlined text-2xl">dark_mode</span>
                <span x-show="darkMode" class="material-symbols-outlined text-2xl text-amber-400">light_mode</span>
            </button>
        </div>

        <!-- Settings Button -->
        <div class="flex items-center">
            <button x-on:click="window.location.href = '{{ Auth::user()->usertype == 1 ? route('admin.settings') : route('employee.settings') }}'" 
                    class="text-gray-500 hover:text-indigo-600 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                <span class="material-symbols-outlined text-2xl">settings</span>
            </button>
        </div>

        <!-- User Dropdown -->
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="user-profile-button flex items-center space-x-2 p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 border border-transparent hover:border-gray-200 dark:hover:border-gray-600 focus:outline-none">
                    <x-profile-photo size="h-7 w-7" />
                    <div class="hidden sm:flex flex-col items-start text-left ml-1">
                        <span class="text-xs font-bold text-gray-900 dark:text-white leading-none">{{ $userName }}</span>
                    </div>
                    <span class="material-symbols-outlined text-sm text-gray-400">keyboard_arrow_down</span>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-600 bg-gray-50/50 dark:bg-gray-800/50">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Signed in as</p>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ Auth::user()->username }}</p>
                </div>

                <x-dropdown-link :href="Auth::user()->usertype == 1 ? route('admin.profile') : route('employee.profile')" class="flex items-center">
                    <span class="material-symbols-outlined text-lg mr-3">person</span>
                    Profile
                </x-dropdown-link>

                <div class="border-t border-gray-100 dark:border-gray-600"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-red-600 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/10 flex items-center">
                        <span class="material-symbols-outlined text-lg mr-3">logout</span>
                        Sign Out
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
