<x-layouts.app :userName="$admin_name">
    <x-slot:title>Admin - Pending Documents</x-slot>

    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Admin: Pending Documents</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Review all documents currently pending action in the system.</p>
        </div>

        <x-document.table :documents="$documents" emptyMessage="No pending documents found." />
    </div>
</x-layouts.app>
