<x-layouts.app :userName="$employee_name">
    <x-slot:title>Pending Documents</x-slot>

    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Pending Documents</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Documents that are currently being processed.</p>
        </div>

        <x-document.table :documents="$documents" emptyMessage="No pending documents found." />
    </div>
</x-layouts.app>
