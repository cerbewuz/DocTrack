<x-layouts.app :userName="$admin_name">
    <x-slot:title>Admin - Document Archive</x-slot>

    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Admin: System Archive</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Full history of archived documents across all departments.</p>
        </div>

        <x-document.table :documents="$documents" emptyMessage="No archived documents found in the system." />
    </div>
</x-layouts.app>
