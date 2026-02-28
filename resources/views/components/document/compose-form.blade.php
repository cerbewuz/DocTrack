@props([
    'actionRoute',
    'users',
    'prioritizations',
    'classifications',
    'subclassifications',
    'actions'
])

<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden"
     x-data="{ 
        selectedClassification: '{{ old('classification') }}',
        allSubclassifications: {{ $subclassifications->toJson() }},
        get filteredSubclassifications() {
            if (!this.selectedClassification) return [];
            // Find the classification ID based on the name
            const classifications = {{ $classifications->toJson() }};
            const classification = classifications.find(c => c.name === this.selectedClassification);
            if (!classification) return [];
            return this.allSubclassifications.filter(s => s.classification_id === classification.id);
        }
     }">
    <form method="POST" action="{{ $actionRoute }}" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="p-8 space-y-8">
            <!-- General Information Section -->
            <section class="space-y-6">
                <div class="flex items-center space-x-2 pb-2 border-b border-gray-100 dark:border-gray-700">
                    <span class="material-symbols-outlined text-indigo-500">info</span>
                    <h2 class="text-sm font-bold uppercase tracking-wider text-gray-400">General Information</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight">From</label>
                        <input type="text" value="{{ Auth::user()->email }}" readonly 
                               class="w-full bg-gray-50 dark:bg-gray-900/50 border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-500 focus:ring-0 cursor-not-allowed">
                        <input type="hidden" name="sender_user_id" value="{{ Auth::user()->id }}">
                    </div>

                    <div class="space-y-1">
                        <label for="receiver_user_id" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight">To (Receiver)</label>
                        <select name="receiver_user_id" id="receiver_user_id"
                                class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all">
                            <option value="" disabled selected>Select Recipient</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('receiver_user_id') == $user->id ? 'selected' : '' }}>{{ $user->email }} ({{ $user->username }})</option>
                            @endforeach
                        </select>
                        @error('receiver_user_id') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="subject" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight">Subject</label>
                    <input type="text" name="subject" id="subject" placeholder="Enter document subject" value="{{ old('subject') }}"
                           class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all">
                    @error('subject') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1">
                    <label for="description" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight">Description</label>
                    <textarea name="description" id="description" rows="3" placeholder="Briefly describe the document contents..."
                              class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                </div>
            </section>

            <!-- Document Details Section -->
            <section class="space-y-6">
                <div class="flex items-center space-x-2 pb-2 border-b border-gray-100 dark:border-gray-700">
                    <span class="material-symbols-outlined text-indigo-500">settings</span>
                    <h2 class="text-sm font-bold uppercase tracking-wider text-gray-400">Document Classification & Timeline</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-1">
                        <label for="prioritization" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight">Prioritization</label>
                        <select name="prioritization" id="prioritization"
                                class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all">
                            <option value="" disabled selected>Select Priority</option>
                            @foreach ($prioritizations as $prioritization)
                                <option value="{{ $prioritization->name }}" {{ old('prioritization') == $prioritization->name ? 'selected' : '' }}>{{ $prioritization->name }}</option>
                            @endforeach
                        </select>
                        @error('prioritization') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="classification" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight">Classification</label>
                        <select name="classification" id="classification" x-model="selectedClassification"
                                class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all">
                            <option value="" disabled selected>Select Type</option>
                            @foreach ($classifications as $classification)
                                <option value="{{ $classification->name }}">{{ $classification->name }}</option>
                            @endforeach
                        </select>
                        @error('classification') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="sub_classification" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight">Sub-Classification</label>
                        <select name="subclassification" id="sub_classification"
                                class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all"
                                :disabled="!selectedClassification">
                            <option value="" disabled :selected="!selectedClassification">Select Sub-Type</option>
                            <template x-for="sub in filteredSubclassifications" :key="sub.id">
                                <option :value="sub.name" x-text="sub.name" :selected="sub.name === '{{ old('subclassification') }}'"></option>
                            </template>
                        </select>
                        @error('subclassification') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label for="action" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight">Required Action</label>
                        <select name="action" id="action"
                                class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all">
                            <option value="" disabled selected>Select Action</option>
                            @foreach ($actions as $action)
                                <option value="{{ $action->name }}" {{ old('action') == $action->name ? 'selected' : '' }}>{{ $action->name }}</option>
                            @endforeach
                        </select>
                        @error('action') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="deadline" class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight">Deadline</label>
                        <input type="datetime-local" name="deadline" id="deadline" value="{{ old('deadline') }}"
                               class="w-full bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all">
                        @error('deadline') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-2" x-data="{ fileName: '{{ old('file') }}', fileSelected: {{ old('file') ? 'true' : 'false' }} }">
                    <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-tight">Attachment</label>
                    <div class="relative group">
                        <div class="flex items-center justify-center w-full px-6 py-10 border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-2xl group-hover:border-indigo-500 dark:group-hover:border-indigo-400 transition-all bg-gray-50/50 dark:bg-gray-900/30"
                             :class="{ 'border-indigo-500 bg-indigo-50/30 dark:bg-indigo-900/20': fileSelected }">
                            <div class="space-y-2 text-center">
                                <span class="material-symbols-outlined text-4xl transition-colors"
                                      :class="fileSelected ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-400 group-hover:text-indigo-500'">
                                    <template x-if="!fileSelected"><span>upload_file</span></template>
                                    <template x-if="fileSelected"><span>task</span></template>
                                </span>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center items-center">
                                    <label for="file-upload" class="relative cursor-pointer font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 transition-colors">
                                        <span x-text="fileSelected ? 'Change file' : 'Upload a file'"></span>
                                        <input id="file-upload" name="file" type="file" class="sr-only" accept=".pdf, .doc, .docx, .xls, .xlsx, .csv"
                                               @change="if($event.target.files.length > 0) { fileSelected = true; fileName = $event.target.files[0].name; }">
                                    </label>
                                    <button type="button" x-show="fileSelected" @click="fileSelected = false; fileName = ''; document.getElementById('file-upload').value = ''" 
                                            class="ml-2 p-1 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-full transition-colors flex items-center justify-center" title="Remove file">
                                        <span class="material-symbols-outlined text-sm">close</span>
                                    </button>
                                    <p class="pl-1" x-show="!fileSelected">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-500" x-show="!fileSelected">PDF, DOC, XLS up to 10MB</p>
                                <p class="text-sm font-bold text-indigo-600 dark:text-indigo-400 animate-bounce" x-show="fileSelected" x-text="fileName"></p>
                            </div>
                        </div>
                    </div>
                    @error('file')
                        <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </section>
        </div>

        <div class="px-8 py-6 bg-gray-50/80 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-700 flex items-center justify-end space-x-4">
            <input type="hidden" name="is_draft" id="is_draft" value="0">
            <a href="{{ Auth::user()->usertype == 1 ? route('admin.home') : route('employee.home') }}" 
               class="px-6 py-2.5 text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                Cancel
            </a>
            <button type="submit" onclick="document.getElementById('is_draft').value = '1'"
                    class="px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl text-sm font-bold hover:bg-gray-300 dark:hover:bg-gray-600 transition-all">
                Save as Draft
            </button>
            <button type="submit" onclick="document.getElementById('is_draft').value = '0'"
                    class="px-8 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-200 dark:shadow-none transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                Submit Document
            </button>
        </div>
    </form>
</div>
