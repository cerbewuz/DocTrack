<x-layouts.app :userName="$admin_name">
    <x-slot:title>Admin - Incoming Documents</x-slot>

    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Admin: Incoming Documents</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Monitor and manage all incoming documents across the system.</p>
            </div>
            
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.compose') }}" class="flex items-center space-x-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-lg">add</span>
                    <span>New Document</span>
                </a>
            </div>
        </div>

        <x-document.table :documents="$documents" emptyMessage="No incoming documents found in the system." />
    </div>
</x-layouts.app>
