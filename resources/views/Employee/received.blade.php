<x-layouts.app :userName="$employee_name">
    <x-slot:title>Received Documents</x-slot>

    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Received Documents</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Documents that have been successfully received and completed.</p>
        </div>

        <x-document.table :documents="$documents" emptyMessage="No received documents found." />
    </div>
</x-layouts.app>
