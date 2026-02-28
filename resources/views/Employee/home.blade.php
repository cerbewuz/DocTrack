<x-layouts.app :userName="$employee_name">
    <x-slot:title>Employee Dashboard</x-slot>

    <style>
        .dashboard-row {
            display: grid !important;
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 1.5rem !important;
            width: 100% !important;
        }
        @media (max-width: 1024px) {
            .dashboard-row {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
        @media (max-width: 640px) {
            .dashboard-row {
                grid-template-columns: 1fr !important;
            }
        }
    </style>

    <div class="space-y-6">
        <!-- Welcome Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Welcome back, {{ $employee_name }}!</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Here's what's happening with your documents today.</p>
            </div>
            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="dashboard-row">
            <!-- My Task -->
            <x-dashboard.card 
                title="My Tasks" 
                :count="$incomingCount" 
                id="task-counter"
                icon="assignment"
                color="blue"
                route="employee.incoming"
            />

            <!-- Contributed -->
            <x-dashboard.card 
                title="Contributed" 
                :count="$pendingCount" 
                id="contributed-counter"
                icon="share"
                color="amber"
                route="employee.pending"
            />

            <!-- Outgoing -->
            <x-dashboard.card 
                title="Outgoing" 
                :count="$outgoingCount" 
                id="outgoing-doc-counter"
                icon="send"
                color="green"
                route="employee.outgoing"
            />

            <!-- Finished -->
            <x-dashboard.card 
                title="Finished" 
                :count="$receivedCount" 
                id="finished-counter"
                icon="task_alt"
                color="rose"
                route="employee.received"
            />
        </div>

        <!-- Recent Activity Placeholder -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <h2 class="text-lg font-semibold mb-4 flex items-center">
                <span class="material-symbols-outlined mr-2 text-indigo-500">history</span>
                Recent Activity
            </h2>
            <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                <span class="material-symbols-outlined text-5xl mb-2">query_stats</span>
                <p>No recent activity to show.</p>
            </div>
        </div>
    </div>
</x-layouts.app>
