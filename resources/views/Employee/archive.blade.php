<x-layouts.app :userName="$employee_name">
    <x-slot:title>Archived Documents</x-slot>

    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Document Archive</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Access and manage your archived document history.</p>
        </div>

        <x-document.table :documents="$documents" emptyMessage="No archived documents found." />
    </div>
</x-layouts.app>
