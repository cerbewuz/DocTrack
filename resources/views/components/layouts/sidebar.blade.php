<aside 
    class="bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 w-64 min-w-[16rem] max-w-[16rem] flex-shrink-0 h-screen !important sidebar-transition overflow-y-auto"
    :class="sidebarOpen ? 'ml-0' : '-ml-64'"
>
    <div class="flex flex-col h-full">
        <!-- Placeholder to maintain navigation position after logo removal -->
        <div class="h-16 mb-6"></div>

        <!-- Navigation -->
        <nav class="flex-1 space-y-1">
            @php
                $role = Auth::user()->usertype == 1 ? 'admin' : 'employee';
                
                $links = [
                    ['route' => "$role.home", 'icon' => 'home', 'label' => 'Dashboard'],
                    ['route' => "$role.incoming", 'icon' => 'move_to_inbox', 'label' => 'Incoming'],
                    ['route' => "$role.pending", 'icon' => 'pending_actions', 'label' => 'Pending'],
                    ['route' => "$role.received", 'icon' => 'check_circle', 'label' => 'Received'],
                    ['route' => "$role.outgoing", 'icon' => 'outgoing_mail', 'label' => 'Outgoing'],
                    ['route' => "$role.drafts", 'icon' => 'drafts', 'label' => 'Drafts'],
                    ['route' => "$role.archive", 'icon' => 'archive', 'label' => 'Archive'],
                ];
            @endphp

            <div class="mb-6 flex justify-center">
                <a href="{{ route("$role.compose") }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl transition-all duration-200 shadow-lg shadow-indigo-200 dark:shadow-none font-bold text-xs uppercase tracking-widest">
                    Compose Document
                </a>
            </div>

            <div class="space-y-1">
                @foreach($links as $link)
                    <a href="{{ route($link['route']) }}" 
                       class="flex items-center space-x-3 px-4 py-2.5 rounded-lg transition-all duration-200 group {{ request()->routeIs($link['route']) ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-white' }}">
                        <span class="material-symbols-outlined text-2xl {{ request()->routeIs($link['route']) ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300' }}">
                            {{ $link['icon'] }}
                        </span>
                        <span class="font-medium text-sm">{{ $link['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </nav>

       
    </div>
</aside>
