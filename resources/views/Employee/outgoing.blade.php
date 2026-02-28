<x-layouts.app :userName="$employee_name">
    <x-slot:title>Outgoing Documents</x-slot>

    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Outgoing Documents</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Documents you have sent to other departments or users.</p>
        </div>

        <x-document.table :documents="$documents" emptyMessage="No outgoing documents found." />
    </div>
</x-layouts.app>
