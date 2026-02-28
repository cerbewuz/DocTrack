@props(['documents', 'emptyMessage' => 'No documents found.'])

<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
    <div class="relative">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700">
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Document ID</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Subject & Details</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Required Action</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Timeline</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse ($documents as $document)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600 dark:text-indigo-400">
                            {{ $document->document_id }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $document->subject }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1 mt-0.5">{{ $document->description }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300">
                                {{ $document->action }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'incoming' => 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300',
                                    'pending' => 'bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300',
                                    'received' => 'bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300',
                                    'outgoing' => 'bg-purple-50 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300',
                                    'archive' => 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300',
                                ];
                                $color = $statusColors[$document->status] ?? 'bg-gray-50 text-gray-700';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $color }}">
                                {{ ucfirst($document->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-xs text-gray-900 dark:text-white font-medium">Created: {{ $document->created_at->format('M d, Y') }}</div>
                            <div class="text-[10px] text-rose-500 dark:text-rose-400 font-bold mt-1 uppercase tracking-tighter italic">Deadline: {{ \Carbon\Carbon::parse($document->deadline)->format('M d, Y') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div x-data="{ open: false }" class="relative inline-block text-left">
                                <button @click="open = !open" @click.away="open = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors p-1 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <span class="material-symbols-outlined">more_vert</span>
                                </button>
                                
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-xl py-1 border border-gray-100 dark:border-gray-700 z-10">
                                    
                                    <a href="{{ route('documents.show', ltrim($document->document_id, '#')) }}" class="flex items-center px-4 py-2 text-xs text-gray-700 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                        <span class="material-symbols-outlined text-sm mr-2">visibility</span>
                                        View Document
                                    </a>
                                    
                                    @if($document->status !== 'pending')
                                    <a href="{{ route('documents.moveToPending', ltrim($document->document_id, '#')) }}" class="flex items-center px-4 py-2 text-xs text-gray-700 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                        <span class="material-symbols-outlined text-sm mr-2">pending</span>
                                        Move to Pending
                                    </a>
                                    @endif

                                    @if($document->status !== 'archive')
                                    <a href="{{ route('documents.moveToArchive', ltrim($document->document_id, '#')) }}" class="flex items-center px-4 py-2 text-xs text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors">
                                        <span class="material-symbols-outlined text-sm mr-2">archive</span>
                                        Move to Archive
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center">
                                <span class="material-symbols-outlined text-5xl mb-2">inbox</span>
                                <p>{{ $emptyMessage }}</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($documents->count() > 0)
        <div class="bg-gray-50 dark:bg-gray-900/50 px-6 py-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
            <div class="text-xs text-gray-500 dark:text-gray-400">
                Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $documents->count() }}</span> results
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md text-xs font-medium text-gray-500 cursor-not-allowed">Previous</button>
                <button class="px-3 py-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md text-xs font-medium text-gray-700 hover:bg-gray-50">Next</button>
            </div>
        </div>
    @endif
</div>
