<x-layouts.app :userName="$admin_name">
    <x-slot:title>Admin - Outgoing Documents</x-slot>

    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Admin: Outgoing Documents</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Track all documents sent within or outside the organization.</p>
        </div>

        <x-document.table :documents="$documents" emptyMessage="No outgoing documents found." />
    </div>
</x-layouts.app>
