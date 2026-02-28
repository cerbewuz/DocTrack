<x-layouts.app :userName="$admin_name">
    <x-slot:title>Admin Dashboard</x-slot>

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
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Admin Dashboard</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">System-wide document overview and management.</p>
            </div>
            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="dashboard-row">
            <!-- My Task -->
            <x-dashboard.card 
                title="System Tasks" 
                :count="$incomingCount" 
                id="task-counter"
                icon="admin_panel_settings"
                color="blue"
                route="admin.incoming"
            />

            <!-- Contributed -->
            <x-dashboard.card 
                title="Total Contributions" 
                :count="$pendingCount" 
                id="contributed-counter"
                icon="analytics"
                color="amber"
                route="admin.pending"
            />

            <!-- Outgoing -->
            <x-dashboard.card 
                title="Global Outgoing" 
                :count="$outgoingCount" 
                id="outgoing-doc-counter"
                icon="unfold_more"
                color="green"
                route="admin.outgoing"
            />

            <!-- Finished -->
            <x-dashboard.card 
                title="Global Finished" 
                :count="$receivedCount" 
                id="finished-counter"
                icon="done_all"
                color="rose"
                route="admin.received"
            />
        </div>

        <!-- System Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <span class="material-symbols-outlined mr-2 text-indigo-500">monitoring</span>
                    System Health
                </h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Total Users</span>
                        <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400">Active</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Database Status</span>
                        <span class="text-sm font-bold text-green-600 dark:text-green-400">Connected</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <span class="material-symbols-outlined mr-2 text-indigo-500">history</span>
                    Recent Activity
                </h2>
                <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                    <span class="material-symbols-outlined text-5xl mb-2">query_stats</span>
                    <p>No recent activity logs.</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
