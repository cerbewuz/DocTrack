<x-layouts.app :userName="$admin_name">
    <x-slot:title>Admin - Profile</x-slot>

    <div class="max-w-5xl mx-auto space-y-6" x-data="{ editingInfo: false, editingSecurity: false }">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Profile Settings</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm italic">Manage your account information and security settings.</p>
        </div>

        @if (session('status'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const isDark = localStorage.getItem('dark-mode') === 'enabled';
                    const status = "{{ session('status') }}";
                    let message = "Changes saved successfully!";
                    
                    if (status === 'profile-updated') message = "Personal information updated.";
                    if (status === 'password-updated') message = "Password changed successfully.";
                    if (status === 'photo-updated') message = "Profile photo updated.";

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: message,
                        confirmButtonColor: '#4f46e5',
                        background: isDark ? '#1f2937' : '#fff',
                        color: isDark ? '#fff' : '#1f2937',
                        customClass: {
                            popup: 'rounded-3xl',
                            confirmButton: 'rounded-xl px-6 py-2.5 font-bold'
                        }
                    });
                });
            </script>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Side: Profile Summary -->
            <div class="md:col-span-1 space-y-6">
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-gray-700 text-center relative group overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-b from-indigo-500/5 to-transparent pointer-events-none"></div>
                    <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data" id="photo-form">
                        @csrf
                        <div class="relative inline-block mb-6">
                            <!-- Profile Photo Component -->
                            <x-profile-photo size="h-48 w-48" border="border-8" rounded="rounded-full" id="profile-preview-container" class="shadow-2xl rounded-full">
                                <!-- Loading Spinner -->
                                <div id="upload-spinner" class="hidden absolute inset-0 bg-black/50 flex items-center justify-center rounded-full backdrop-blur-sm z-10">
                                    <div class="animate-spin rounded-full h-10 w-10 border-4 border-white border-t-transparent"></div>
                                </div>

                                <x-slot name="actions">
                                    <!-- Upload Button: Accurately positioned half-in, half-out, fully clickable -->
                                    <label for="profile_photo" 
                                           class="absolute bg-indigo-600 text-white rounded-full shadow-2xl hover:bg-indigo-700 transition-all cursor-pointer hover:scale-110 active:scale-95 border-4 border-white dark:border-gray-800 flex items-center justify-center ring-1 ring-black/5"
                                           style="right: 14.6%; bottom: 14.6%; width: 3rem; height: 3rem; transform: translate(50%, 50%); z-index: 50; cursor: pointer;">
                                        <span class="material-symbols-outlined text-xl">photo_camera</span>
                                        <input type="file" id="profile_photo" name="profile_photo" class="hidden" onchange="submitPhotoForm()">
                                    </label>
                                </x-slot>
                            </x-profile-photo>
                        </div>
                        @error('profile_photo')
                            <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </form>

                    <script>
                        function submitPhotoForm() {
                            const input = document.getElementById('profile_photo');
                            const spinner = document.getElementById('upload-spinner');
                            if (input && input.files && input.files[0]) {
                                if (spinner) spinner.classList.remove('hidden');
                                document.getElementById('photo-form').submit();
                            }
                        }
                    </script>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ Auth::user()->email }}</p>
                    <div class="mt-4 flex justify-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 tracking-wide uppercase">
                            Administrator
                        </span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                    <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4">Account Overview</h3>
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 dark:text-gray-400">Account Type</span>
                            <span class="font-bold dark:text-gray-200">Admin</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 dark:text-gray-400">Joined</span>
                            <span class="font-bold dark:text-gray-200">{{ Auth::user()->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Detailed Forms -->
            <div class="md:col-span-2 space-y-6">
                <!-- Personal Information -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                            <span class="material-symbols-outlined mr-2 text-indigo-500">contact_page</span>
                            Personal Information
                        </h2>
                        <button type="button" @click="editingInfo = !editingInfo" 
                                class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline flex items-center transition-all">
                            <span class="material-symbols-outlined text-sm mr-1" x-text="editingInfo ? 'close' : 'edit'">edit</span>
                            <span x-text="editingInfo ? 'Cancel' : 'Edit Info'">Edit Info</span>
                        </button>
                    </div>
                    <form action="{{ route('profile.update') }}" method="POST" class="p-6">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">First Name</label>
                                <p class="text-sm font-medium text-gray-900 dark:text-white py-1" x-show="!editingInfo">{{ Auth::user()->firstname }}</p>
                                <input type="text" value="{{ Auth::user()->firstname }}" readonly x-show="editingInfo" class="w-full bg-gray-50 dark:bg-gray-900/50 border-gray-100 dark:border-gray-800 rounded-xl text-sm font-medium focus:ring-0 cursor-not-allowed italic opacity-70">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Last Name</label>
                                <p class="text-sm font-medium text-gray-900 dark:text-white py-1" x-show="!editingInfo">{{ Auth::user()->lastname }}</p>
                                <input type="text" value="{{ Auth::user()->lastname }}" readonly x-show="editingInfo" class="w-full bg-gray-50 dark:bg-gray-900/50 border-gray-100 dark:border-gray-800 rounded-xl text-sm font-medium focus:ring-0 cursor-not-allowed italic opacity-70">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Username</label>
                                <p class="text-sm font-medium text-gray-900 dark:text-white py-1" x-show="!editingInfo">{{ Auth::user()->username }}</p>
                                <input type="text" id="username" name="username" value="{{ old('username', Auth::user()->username) }}" required x-show="editingInfo" class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200 shadow-sm">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Gender</label>
                                <p class="text-sm font-medium text-gray-900 dark:text-white py-1" x-show="!editingInfo">{{ Auth::user()->gender ?? 'Not Specified' }}</p>
                                <input type="text" value="{{ Auth::user()->gender }}" readonly x-show="editingInfo" class="w-full bg-gray-50 dark:bg-gray-900/50 border-gray-100 dark:border-gray-800 rounded-xl text-sm font-medium focus:ring-0 cursor-not-allowed italic opacity-70">
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Email Address</label>
                                <p class="text-sm font-medium text-gray-900 dark:text-white py-1" x-show="!editingInfo">{{ Auth::user()->email }}</p>
                                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required x-show="editingInfo" class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200 shadow-sm">
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Birthdate</label>
                                <p class="text-sm font-medium text-gray-900 dark:text-white py-1" x-show="!editingInfo">{{ Auth::user()->birthdate ? Auth::user()->birthdate->format('F j, Y') : 'Not Specified' }}</p>
                                <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate', Auth::user()->birthdate ? Auth::user()->birthdate->format('Y-m-d') : '') }}" x-show="editingInfo" class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200 shadow-sm">
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end" x-show="editingInfo" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <button type="submit" class="px-8 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-200 dark:shadow-none transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Account Security -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                            <span class="material-symbols-outlined mr-2 text-indigo-500">lock_reset</span>
                            Account Security
                        </h2>
                        <button type="button" @click="editingSecurity = !editingSecurity" 
                                class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline flex items-center transition-all">
                            <span class="material-symbols-outlined text-sm mr-1" x-text="editingSecurity ? 'close' : 'edit'">edit</span>
                            <span x-text="editingSecurity ? 'Cancel' : 'Change Password'">Change Password</span>
                        </button>
                    </div>
                    <div class="p-6" x-show="!editingSecurity">
                        <div class="flex items-center space-x-3 text-gray-500">
                            <span class="material-symbols-outlined">security</span>
                            <p class="text-sm">Password was last changed {{ Auth::user()->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <form action="{{ route('profile.password.update') }}" method="POST" class="p-6 space-y-6" x-show="editingSecurity" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                        @csrf
                        @method('PUT')
                        <div class="space-y-2">
                            <label for="current_password" class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest ml-1">Current Password</label>
                            <input type="password" id="current_password" name="current_password" required class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200 shadow-sm">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="password" class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest ml-1">New Password</label>
                                <input type="password" id="password" name="password" required class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200 shadow-sm">
                            </div>
                            <div class="space-y-2">
                                <label for="password_confirmation" class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest ml-1">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all dark:text-gray-200 shadow-sm">
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="px-8 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-200 dark:shadow-none transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
