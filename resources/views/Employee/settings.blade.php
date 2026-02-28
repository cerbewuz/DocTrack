<x-layouts.app :userName="$employee_name">
    <x-slot:title>Employee - Settings</x-slot>

    <div class="max-w-4xl mx-auto space-y-8 pb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">System Settings</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm italic font-medium">Configure your application preferences and appearance.</p>
        </div>

        <div class="grid grid-cols-1 gap-8">
            <!-- Appearance Settings -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300">
                <div class="p-8 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        <span class="material-symbols-outlined mr-3 text-indigo-500 p-2 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl">palette</span>
                        Application Preferences
                    </h2>
                </div>
                <div class="p-8 space-y-8">
                    <!-- Dark Mode -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-gray-100 dark:border-gray-800">
                        <div class="flex items-center space-x-4">
                            <span class="material-symbols-outlined text-indigo-500 bg-indigo-50 dark:bg-indigo-900/30 p-2 rounded-lg">dark_mode</span>
                            <div>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Dark Mode</p>
                                <p class="text-xs text-gray-500 italic">Toggle theme appearance</p>
                            </div>
                        </div>
                        <button @click="toggleDarkMode()" 
                                class="relative inline-flex h-7 w-12 items-center rounded-full transition-colors duration-200 focus:outline-none"
                                :class="darkMode ? 'bg-indigo-600' : 'bg-gray-300'">
                            <span class="inline-block h-5 w-5 transform rounded-full bg-white shadow-md transition duration-200 ease-in-out"
                                  :class="darkMode ? 'translate-x-6' : 'translate-x-1'"></span>
                        </button>
                    </div>

                    <!-- Email Notifications -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-gray-100 dark:border-gray-800">
                        <div class="flex items-center space-x-4">
                            <span class="material-symbols-outlined text-emerald-500 bg-emerald-50 dark:bg-emerald-900/30 p-2 rounded-lg">notifications</span>
                            <div>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Email Notifications</p>
                                <p class="text-xs text-gray-500 italic">Alerts for document assignments</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-12 h-7 bg-gray-300 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600 shadow-sm"></div>
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300">
                <div class="p-8 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        <span class="material-symbols-outlined mr-3 text-amber-500 p-2 bg-amber-50 dark:bg-amber-900/30 rounded-xl">link</span>
                        Account Management
                    </h2>
                </div>
                <div class="p-8">
                    <a href="{{ route('employee.profile') }}" class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-gray-900/50 rounded-2xl transition-all group border border-transparent hover:border-gray-100 dark:hover:border-gray-800">
                        <div class="flex items-center space-x-4">
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-indigo-500 transition-colors">person</span>
                            <div>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Profile Settings</p>
                                <p class="text-xs text-gray-500 italic">Update your photo, email and personal details</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-gray-300 group-hover:text-indigo-500 transition-all transform group-hover:translate-x-1">chevron_right</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
