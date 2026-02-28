@props(['document', 'userName', 'backRoute'])

<div class="max-w-5xl mx-auto space-y-6 pb-12">
    <!-- Breadcrumbs/Back -->
    <div class="flex items-center justify-between">
        <a href="{{ $backRoute }}" class="flex items-center text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors">
            <span class="material-symbols-outlined text-lg mr-1">arrow_back</span>
            Back to Documents
        </a>
        <div class="flex items-center space-x-2">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Document ID:</span>
            <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400">{{ $document->document_id }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-8 space-y-8">
                    <div>
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-indigo-50 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300">
                                {{ $document->classification }}
                            </span>
                        </div>
                        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white leading-tight">
                            {{ $document->subject }}
                        </h1>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider flex items-center">
                            <span class="material-symbols-outlined text-lg mr-2">description</span>
                            Description
                        </h3>
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-sm">
                                {{ $document->description ?: 'No description provided.' }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 pt-4 border-t border-gray-50 dark:border-gray-700">
                        <div class="space-y-3">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Sender</h4>
                            <div class="flex items-center space-x-3">
                                <div class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                                    <span class="material-symbols-outlined">person</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold dark:text-gray-200">
                                        {{ $document->sender ? $document->sender->firstname . ' ' . $document->sender->lastname : 'Unknown Sender' }}
                                    </p>
                                    <p class="text-[10px] text-gray-500">{{ $document->sender ? '@' . $document->sender->username : 'Originator' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Receiver</h4>
                            <div class="flex items-center space-x-3">
                                <div class="h-10 w-10 rounded-full bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center text-amber-600 dark:text-amber-400">
                                    <span class="material-symbols-outlined">person_pin</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold dark:text-gray-200">
                                        {{ $document->receiver ? $document->receiver->firstname . ' ' . $document->receiver->lastname : 'Unknown Receiver' }}
                                    </p>
                                    <p class="text-[10px] text-gray-500">{{ $document->receiver ? '@' . $document->receiver->username : 'Intended Recipient' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attachment Section -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <h2 class="text-sm font-bold text-gray-900 dark:text-white flex items-center">
                        <span class="material-symbols-outlined mr-2 text-indigo-500">attachment</span>
                        Attached Document
                    </h2>
                </div>
                <div class="p-6">
                    @if($document->file)
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-gray-100 dark:border-gray-700">
                        <div class="flex items-center space-x-4">
                            <div class="h-12 w-12 rounded-xl bg-white dark:bg-gray-800 flex items-center justify-center shadow-sm text-indigo-600 dark:text-indigo-400 border border-gray-100 dark:border-gray-700">
                                <span class="material-symbols-outlined text-3xl">file_present</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold dark:text-gray-200 truncate max-w-[200px]">{{ $document->file }}</p>
                                <p class="text-xs text-gray-400 uppercase text-[10px] font-bold tracking-widest">{{ pathinfo($document->file, PATHINFO_EXTENSION) }} Document</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            @php
                                $ext = strtolower(pathinfo($document->file, PATHINFO_EXTENSION));
                                $viewable = in_array($ext, ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                            @endphp
                            
                            @if($viewable)
                            <button x-on:click="$dispatch('open-modal', 'view-document-modal')" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-all shadow-lg shadow-indigo-100 dark:shadow-none flex items-center space-x-2">
                                <span class="material-symbols-outlined text-sm">visibility</span>
                                <span>Preview</span>
                            </button>
                            @endif

                            <a href="{{ route('documents.download', ltrim($document->document_id, '#')) }}" class="px-5 py-2.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-xl text-xs font-bold transition-all flex items-center space-x-2">
                                <span class="material-symbols-outlined text-sm">download</span>
                                <span>Download</span>
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-4 text-gray-500 text-sm italic">
                        No attachment found for this document.
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar/Actions -->
        <div class="space-y-6">
            <!-- Timeline Card -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 space-y-6">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Tracking Timeline</h3>
                    <div class="space-y-6 relative before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-100 dark:before:bg-gray-700">
                        <div class="relative pl-8">
                            <div class="absolute left-0 top-1 h-6 w-6 rounded-full bg-green-500 border-4 border-white dark:border-gray-800 shadow-sm z-10"></div>
                            <p class="text-xs font-bold dark:text-gray-200 uppercase">Created</p>
                            <p class="text-[10px] text-gray-500">{{ $document->created_at->format('M d, Y - h:i A') }}</p>
                        </div>
                        <div class="relative pl-8">
                            <div class="absolute left-0 top-1 h-6 w-6 rounded-full bg-indigo-500 border-4 border-white dark:border-gray-800 shadow-sm z-10"></div>
                            <p class="text-xs font-bold dark:text-gray-200 uppercase">Deadline</p>
                            <p class="text-[10px] text-rose-500 font-bold uppercase">{{ \Carbon\Carbon::parse($document->deadline)->format('M d, Y - h:i A') }}</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-50 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-gray-400 uppercase">Urgency</span>
                        @php
                            $urgencyColor = 'text-indigo-500';
                            $urgencyLabel = $document->prioritization;
                            if (stripos($urgencyLabel, 'High') !== false) $urgencyColor = 'text-rose-500';
                            if (stripos($urgencyLabel, 'Urgent') !== false) $urgencyColor = 'text-rose-600';
                        @endphp
                        <span class="text-[10px] font-black {{ $urgencyColor }} uppercase tracking-tighter">{{ $urgencyLabel }}</span>
                    </div>
                    <div class="h-2 w-full bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-500 w-full rounded-full" style="width: {{ stripos($document->prioritization, 'High') !== false ? '100%' : '50%' }}"></div>
                    </div>
                </div>
            </div>

            <!-- Action Center -->
            <div class="bg-indigo-900 rounded-3xl p-6 shadow-xl shadow-indigo-200 dark:shadow-none space-y-4">
                <h3 class="text-xs font-bold text-indigo-300 uppercase tracking-widest">Action Center</h3>
                <div class="space-y-3">
                    <p class="text-[10px] text-indigo-400 font-medium">Required Action:</p>
                    <p class="text-lg font-black text-white leading-tight uppercase">{{ $document->action }}</p>
                    
                    <div class="grid grid-cols-1 gap-3 pt-4">
                        @if($document->status !== 'pending')
                        <a href="{{ route('documents.moveToPending', ltrim($document->document_id, '#')) }}" class="flex items-center justify-center space-x-2 w-full px-4 py-3 bg-white hover:bg-indigo-50 text-indigo-900 rounded-2xl text-xs font-bold transition-all transform hover:-translate-y-0.5">
                            <span class="material-symbols-outlined text-lg">pending</span>
                            <span>Mark as Pending</span>
                        </a>
                        @endif
                        
                        @if($document->status !== 'archive')
                        <a href="{{ route('documents.moveToArchive', ltrim($document->document_id, '#')) }}" class="flex items-center justify-center space-x-2 w-full px-4 py-3 bg-indigo-800 hover:bg-indigo-700 text-white rounded-2xl text-xs font-bold transition-all transform hover:-translate-y-0.5">
                            <span class="material-symbols-outlined text-lg">archive</span>
                            <span>Archive Document</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($document->file)
@php
    $ext = strtolower(pathinfo($document->file, PATHINFO_EXTENSION));
    $fileUrl = asset('document/' . $document->file);
    $isPdf = $ext === 'pdf';
    $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
@endphp

<x-modal name="view-document-modal" maxWidth="{{ $isPdf ? '5xl' : '3xl' }}" focusable>
    <div class="flex flex-col bg-white dark:bg-gray-800 overflow-hidden rounded-2xl" 
         style="height: 85vh; max-height: 85vh;" 
         x-data="{ 
            zoom: 100, 
            rotation: 0
         }"
         x-on:open-modal.window="if($event.detail == 'view-document-modal') { zoom = 100; rotation = 0; }"
         x-cloak>
        
        <!-- Compact Header -->
        <div class="flex-none px-4 py-3 bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <div class="flex items-center space-x-3 min-w-0">
                <div class="h-8 w-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white flex-shrink-0">
                    <span class="material-symbols-outlined text-base">description</span>
                </div>
                <div class="min-w-0">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $document->subject }}</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $document->file }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-2 flex-shrink-0">
                <a href="{{ route('documents.download', ltrim($document->document_id, '#')) }}"
                   class="h-8 px-3 flex items-center justify-center bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg text-xs font-medium transition-colors hover:bg-gray-200 dark:hover:bg-gray-600"
                   title="Download">
                    <span class="material-symbols-outlined text-base">download</span>
                </a>
                
                <button x-on:click="$dispatch('close-modal', 'view-document-modal')" 
                        class="h-8 w-8 flex items-center justify-center text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
        </div>

        <!-- Content Area -->
        <div class="flex-1 flex overflow-hidden bg-gray-100 dark:bg-gray-900">
            @if($isPdf)
                <!-- PDF Viewer -->
                <div class="flex-1 min-w-0">
                    <iframe src="{{ $fileUrl }}#toolbar=1&navpanes=1" class="w-full h-full border-none"></iframe>
                </div>
            @elseif($isImage)
                <!-- Image Viewer -->
                <div class="flex-1 flex flex-col">
                    <!-- Image Canvas -->
                    <div class="flex-1 overflow-auto p-6 preview-scrollbar flex items-center justify-center">
                        <div class="inline-block transition-transform duration-300 ease-out" 
                             :style="'transform: rotate(' + rotation + 'deg) scale(' + (zoom/100) + ');'">
                            <img src="{{ $fileUrl }}" 
                                 class="max-w-full shadow-lg rounded"
                                 alt="Document Preview"
                                 draggable="false">
                        </div>
                    </div>

                    <!-- Compact Image Controls -->
                    <div class="flex-none px-4 py-2 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 flex items-center justify-center space-x-1">
                        <button @click="zoom = Math.max(25, zoom - 25)" 
                                class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300 transition-colors" 
                                title="Zoom Out">
                            <span class="material-symbols-outlined text-lg">remove</span>
                        </button>
                        
                        <div class="px-2 min-w-[3rem] text-center">
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300" x-text="zoom + '%'"></span>
                        </div>
                        
                        <button @click="zoom = Math.min(400, zoom + 25)" 
                                class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300 transition-colors" 
                                title="Zoom In">
                            <span class="material-symbols-outlined text-lg">add</span>
                        </button>
                        
                        <div class="h-4 w-px bg-gray-300 dark:bg-gray-600 mx-2"></div>
                        
                        <button @click="rotation = (rotation + 90) % 360" 
                                class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300 transition-colors" 
                                title="Rotate Right">
                            <span class="material-symbols-outlined text-lg">rotate_right</span>
                        </button>
                        
                        <button @click="rotation = (rotation - 90 + 360) % 360" 
                                class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300 transition-colors" 
                                title="Rotate Left">
                            <span class="material-symbols-outlined text-lg">rotate_left</span>
                        </button>
                        
                        <div class="h-4 w-px bg-gray-300 dark:bg-gray-600 mx-2"></div>
                        
                        <button @click="zoom = 100; rotation = 0" 
                                class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300 transition-colors" 
                                title="Reset View">
                            <span class="material-symbols-outlined text-lg">restart_alt</span>
                        </button>
                        
                        <button @click="zoom = 100" 
                                class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300 transition-colors" 
                                title="Fit to Screen">
                            <span class="material-symbols-outlined text-lg">fit_screen</span>
                        </button>
                    </div>
                </div>
            @else
                <!-- Non-Viewable File -->
                <div class="flex-1 flex items-center justify-center p-8">
                    <div class="text-center space-y-4 max-w-xs">
                        <div class="h-16 w-16 rounded-2xl bg-gray-200 dark:bg-gray-700 flex items-center justify-center mx-auto">
                            <span class="material-symbols-outlined text-3xl text-gray-400 dark:text-gray-500">description</span>
                        </div>
                        <div>
                            <h4 class="text-base font-semibold text-gray-900 dark:text-white">Preview Unavailable</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">.{{ $ext }} files cannot be previewed. Download to view.</p>
                        </div>
                        <a href="{{ route('documents.download', ltrim($document->document_id, '#')) }}" 
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition-colors">
                            <span class="material-symbols-outlined text-base mr-1.5">download</span>
                            Download File
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-modal>
@endif

<style>
    .preview-scrollbar::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    .preview-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .preview-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.15);
        border-radius: 4px;
    }
    .preview-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.25);
    }
    .dark .preview-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.15);
    }
    .dark .preview-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.25);
    }
</style>
