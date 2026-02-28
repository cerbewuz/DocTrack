<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('dark-mode') === 'enabled', mobileMenuOpen: false }" :class="{ 'dark': darkMode }" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DocTrack - Streamline your document workflow. Track, route, and manage documents across your organization with priority management, classifications, and deadline tracking.">
    <meta name="keywords" content="document management, document tracking, workflow, document routing">
    <meta name="author" content="DocTrack">
    
    <!-- Open Graph -->
    <meta property="og:title" content="DocTrack - Intelligent Document Management">
    <meta property="og:description" content="Track, route, and manage documents across your organization. From composition to archive, DocTrack keeps your workflow organized.">
    <meta property="og:type" content="website">
    
    <script>
        if (localStorage.getItem('dark-mode') === 'enabled') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <title>DocTrack - Intelligent Document Management</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="icon" href="{{ asset('assets/img/doctracklogo.png') }}">
    
    <style>
        /* Animation utilities */
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .animate-fade-in-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-fade-in-delay-2 { animation-delay: 0.2s; opacity: 0; }
        .animate-fade-in-delay-3 { animation-delay: 0.3s; opacity: 0; }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Connection line flow animation */
        @keyframes lineFlow {
            0% { 
                transform: translateX(-100%);
            }
            100% { 
                transform: translateX(200%);
            }
        }
        .workflow-line {
            position: relative;
            overflow: hidden;
        }
        .workflow-line::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 30%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), rgba(255,255,255,0.9), rgba(255,255,255,0.8), transparent);
            animation: lineFlow 3s ease-in-out infinite;
            border-radius: 9999px;
        }
        
        /* Accent text */
        .gradient-text {
            color: #4f46e5;
        }
        .dark .gradient-text {
            color: #818cf8;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/95 dark:bg-gray-800/95 backdrop-blur-md border-b border-gray-200 dark:border-gray-700" role="navigation" aria-label="Main navigation">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 lg:h-20">
                <div class="flex items-center">
                    <a href="/" class="flex items-center" aria-label="DocTrack Home">
                        <img src="{{ asset('assets/img/doctracklogo.png') }}" class="h-10 lg:h-12 w-auto dark:hidden" alt="DocTrack Logo">
                        <img src="{{ asset('assets/img/whitelogo.png') }}" class="h-10 lg:h-12 w-auto hidden dark:block" alt="DocTrack Logo">
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6 lg:space-x-8">
                    <a href="#features" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Features</a>
                    <a href="#how-it-works" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">How It Works</a>
                    <a href="#about" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">About</a>
                    
                    <div class="h-6 w-px bg-gray-200 dark:bg-gray-700"></div>
                    
                    <!-- Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode; localStorage.setItem('dark-mode', darkMode ? 'enabled' : 'disabled')" 
                            class="p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                            aria-label="Toggle dark mode">
                        <span class="material-symbols-outlined text-xl" x-text="darkMode ? 'light_mode' : 'dark_mode'"></span>
                    </button>
                    
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Sign In</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-lg shadow-indigo-500/25 transition-all transform hover:-translate-y-0.5 hover:shadow-xl hover:shadow-indigo-500/30">
                        Get Started Free
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center space-x-2">
                    <button @click="darkMode = !darkMode; localStorage.setItem('dark-mode', darkMode ? 'enabled' : 'disabled')" 
                            class="p-2 rounded-lg text-gray-500 dark:text-gray-400"
                            aria-label="Toggle dark mode">
                        <span class="material-symbols-outlined text-xl" x-text="darkMode ? 'light_mode' : 'dark_mode'"></span>
                    </button>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-gray-500 hover:text-indigo-600 transition-colors" aria-label="Toggle menu" :aria-expanded="mobileMenuOpen">
                        <span class="material-symbols-outlined text-2xl" x-text="mobileMenuOpen ? 'close' : 'menu'"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200" 
             x-transition:enter-start="opacity-0 -translate-y-4" 
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             @click.away="mobileMenuOpen = false"
             class="md:hidden bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-lg">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="#features" @click="mobileMenuOpen = false" class="block text-base font-medium py-3 px-4 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Features</a>
                <a href="#how-it-works" @click="mobileMenuOpen = false" class="block text-base font-medium py-3 px-4 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">How It Works</a>
                <a href="#about" @click="mobileMenuOpen = false" class="block text-base font-medium py-3 px-4 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">About</a>
                <div class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700 flex flex-col space-y-3">
                    <a href="{{ route('login') }}" class="text-base font-semibold text-center py-3 px-4 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Sign In</a>
                    <a href="{{ route('register') }}" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-center font-bold transition-colors">Get Started Free</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-28 pb-16 lg:pt-40 lg:pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-100 dark:border-indigo-800 mb-8 animate-fade-in">
                    <span class="material-symbols-outlined text-indigo-600 dark:text-indigo-400 text-sm mr-2">verified</span>
                    <span class="text-sm font-semibold text-indigo-700 dark:text-indigo-300">Document Workflow Made Simple</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold tracking-tight mb-6 text-gray-900 dark:text-white animate-fade-in-up animate-fade-in-delay-1">
                    Streamline Your<br class="hidden sm:block">
                    <span class="gradient-text">Document Flow</span>
                </h1>
                
                <p class="max-w-2xl mx-auto text-lg lg:text-xl text-gray-600 dark:text-gray-400 leading-relaxed mb-10 animate-fade-in-up animate-fade-in-delay-2">
                    Track, route, and manage documents across your organization. From composition to archive, DocTrack keeps your workflow organized and on schedule.
                </p>
                
                <!-- Trust indicators -->
                <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-500 mb-4">Trusted features for document management</p>
                    <div class="flex flex-wrap justify-center gap-6 lg:gap-10">
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                            <span class="material-symbols-outlined text-green-500">check_circle</span>
                            <span class="text-sm font-medium">Role-based Access</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                            <span class="material-symbols-outlined text-green-500">check_circle</span>
                            <span class="text-sm font-medium">Priority Tracking</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                            <span class="material-symbols-outlined text-green-500">check_circle</span>
                            <span class="text-sm font-medium">Deadline Management</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 lg:py-28 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 text-sm font-semibold mb-4">Features</span>
                <h2 class="text-3xl lg:text-4xl font-bold mb-4">Everything You Need</h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">A complete document workflow solution designed for teams of all sizes.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Feature 1: Document Routing -->
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg hover:border-indigo-200 dark:hover:border-indigo-800 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 mb-5 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">swap_horiz</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Document Routing</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Send and receive documents between users with clear status tracking — incoming, outgoing, pending, and received.
                    </p>
                </div>

                <!-- Feature 2: Priority & Deadlines -->
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg hover:border-rose-200 dark:hover:border-rose-800 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-rose-100 dark:bg-rose-900/30 rounded-xl flex items-center justify-center text-rose-600 dark:text-rose-400 mb-5 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">priority_high</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Priority & Deadlines</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Set urgency levels and deadlines for each document to ensure time-sensitive tasks are completed on schedule.
                    </p>
                </div>

                <!-- Feature 3: Classification System -->
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg hover:border-amber-200 dark:hover:border-amber-800 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center text-amber-600 dark:text-amber-400 mb-5 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">category</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Classification System</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Organize documents with categories and sub-classifications for easy filtering and retrieval.
                    </p>
                </div>

                <!-- Feature 4: Action Assignment -->
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg hover:border-emerald-200 dark:hover:border-emerald-800 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-5 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">task_alt</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Action Assignment</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Assign required actions to documents — approve, review, sign, or forward — so recipients know exactly what's needed.
                    </p>
                </div>

                <!-- Feature 5: Draft & Archive -->
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg hover:border-blue-200 dark:hover:border-blue-800 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center text-blue-600 dark:text-blue-400 mb-5 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">inventory_2</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Drafts & Archive</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Save documents as drafts before sending, and archive completed documents for future reference.
                    </p>
                </div>

                <!-- Feature 6: File Attachments -->
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg hover:border-violet-200 dark:hover:border-violet-800 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-violet-100 dark:bg-violet-900/30 rounded-xl flex items-center justify-center text-violet-600 dark:text-violet-400 mb-5 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">attach_file</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">File Attachments</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Attach PDF, Word, and Excel files to documents with built-in preview and download capabilities.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 lg:py-28 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-sm font-semibold mb-4">Workflow</span>
                <h2 class="text-3xl lg:text-4xl font-bold mb-4">How It Works</h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Four simple steps to manage your documents from creation to completion.</p>
            </div>

            <div class="relative">
                <!-- Connection Line (Desktop) - Segmented colors matching each step -->
                <div class="hidden lg:block absolute top-10 left-[10%] right-[10%] h-1.5 z-0">
                    <div class="flex h-full w-full workflow-line rounded-full">
                        <div class="w-1/4 bg-indigo-500 rounded-l-full"></div>
                        <div class="w-1/4 bg-green-500"></div>
                        <div class="w-1/4 bg-amber-500"></div>
                        <div class="w-1/4 bg-rose-500 rounded-r-full"></div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-6 relative z-10">
                    <!-- Step 1: Compose -->
                    <div class="relative text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="w-16 h-16 lg:w-20 lg:h-20 mx-auto bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-indigo-500/25 relative z-10 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl lg:text-4xl">edit_document</span>
                            </div>
                            <div class="absolute -top-2 -right-2 w-7 h-7 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center shadow-md border-2 border-indigo-600 z-20">
                                <span class="text-xs font-bold text-indigo-600">1</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Compose</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm max-w-xs mx-auto">
                            Create documents with subject, description, classification, priority, and attachments.
                        </p>
                    </div>

                    <!-- Step 2: Send -->
                    <div class="relative text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="w-16 h-16 lg:w-20 lg:h-20 mx-auto bg-green-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-green-500/25 relative z-10 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl lg:text-4xl">send</span>
                            </div>
                            <div class="absolute -top-2 -right-2 w-7 h-7 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center shadow-md border-2 border-green-600 z-20">
                                <span class="text-xs font-bold text-green-600">2</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Send</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm max-w-xs mx-auto">
                            Route documents to recipients. Track in your Outgoing, their Incoming.
                        </p>
                    </div>

                    <!-- Step 3: Process -->
                    <div class="relative text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="w-16 h-16 lg:w-20 lg:h-20 mx-auto bg-amber-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-amber-500/25 relative z-10 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl lg:text-4xl">pending_actions</span>
                            </div>
                            <div class="absolute -top-2 -right-2 w-7 h-7 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center shadow-md border-2 border-amber-600 z-20">
                                <span class="text-xs font-bold text-amber-600">3</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Process</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm max-w-xs mx-auto">
                            Recipients review and take action — approve, sign, or forward.
                        </p>
                    </div>

                    <!-- Step 4: Archive -->
                    <div class="relative text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="w-16 h-16 lg:w-20 lg:h-20 mx-auto bg-rose-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-rose-500/25 relative z-10 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl lg:text-4xl">archive</span>
                            </div>
                            <div class="absolute -top-2 -right-2 w-7 h-7 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center shadow-md border-2 border-rose-600 z-20">
                                <span class="text-xs font-bold text-rose-600">4</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Archive</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm max-w-xs mx-auto">
                            Completed documents are archived for record-keeping and reference.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Document Status Flow Section -->
    <section class="py-20 lg:py-28 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div>
                    <span class="inline-block px-4 py-1.5 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-sm font-semibold mb-4">Dashboard</span>
                    <h2 class="text-3xl lg:text-4xl font-bold mb-6">Track Every Document Status</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                        Get clear visibility into where each document stands in your workflow. Know the status at every stage.
                    </p>
                    
                    <div class="space-y-3">
                        <div class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-blue-200 dark:hover:border-blue-800 transition-colors">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400 flex-shrink-0">
                                <span class="material-symbols-outlined text-xl">download</span>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-semibold text-sm">Incoming</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Documents sent to you awaiting action</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-green-200 dark:hover:border-green-800 transition-colors">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center text-green-600 dark:text-green-400 flex-shrink-0">
                                <span class="material-symbols-outlined text-xl">upload</span>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-semibold text-sm">Outgoing</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Documents you've sent to others</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-amber-200 dark:hover:border-amber-800 transition-colors">
                            <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center text-amber-600 dark:text-amber-400 flex-shrink-0">
                                <span class="material-symbols-outlined text-xl">schedule</span>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-semibold text-sm">Pending</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Documents in progress or awaiting review</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-rose-200 dark:hover:border-rose-800 transition-colors">
                            <div class="w-10 h-10 bg-rose-100 dark:bg-rose-900/30 rounded-lg flex items-center justify-center text-rose-600 dark:text-rose-400 flex-shrink-0">
                                <span class="material-symbols-outlined text-xl">inventory_2</span>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-semibold text-sm">Archive</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Completed documents stored for records</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <!-- Dashboard mockup -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-2xl shadow-gray-200/50 dark:shadow-none p-5 lg:p-6">
                        <div class="flex items-center justify-between mb-5 pb-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-indigo-600 dark:text-indigo-400 text-lg">dashboard</span>
                                </div>
                                <h3 class="font-bold">Dashboard</h3>
                            </div>
                            <span class="text-[10px] text-gray-400 uppercase tracking-wider font-medium">Preview</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl text-center hover:scale-105 transition-transform cursor-default">
                                <span class="material-symbols-outlined text-2xl text-blue-600 dark:text-blue-400">assignment</span>
                                <p class="text-xl font-bold text-gray-900 dark:text-white mt-1">12</p>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium uppercase">My Tasks</p>
                            </div>
                            <div class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-xl text-center hover:scale-105 transition-transform cursor-default">
                                <span class="material-symbols-outlined text-2xl text-amber-600 dark:text-amber-400">share</span>
                                <p class="text-xl font-bold text-gray-900 dark:text-white mt-1">8</p>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium uppercase">Pending</p>
                            </div>
                            <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-xl text-center hover:scale-105 transition-transform cursor-default">
                                <span class="material-symbols-outlined text-2xl text-green-600 dark:text-green-400">send</span>
                                <p class="text-xl font-bold text-gray-900 dark:text-white mt-1">5</p>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium uppercase">Outgoing</p>
                            </div>
                            <div class="p-4 bg-rose-50 dark:bg-rose-900/20 rounded-xl text-center hover:scale-105 transition-transform cursor-default">
                                <span class="material-symbols-outlined text-2xl text-rose-600 dark:text-rose-400">task_alt</span>
                                <p class="text-xl font-bold text-gray-900 dark:text-white mt-1">24</p>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium uppercase">Finished</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Decorative elements -->
                    <div class="absolute -z-10 -top-4 -right-4 w-full h-full bg-indigo-100 dark:bg-indigo-900/20 rounded-2xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Role-Based Access Section -->
    <section id="about" class="py-20 lg:py-28 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 rounded-full bg-violet-100 dark:bg-violet-900/30 text-violet-700 dark:text-violet-300 text-sm font-semibold mb-4">User Roles</span>
                <h2 class="text-3xl lg:text-4xl font-bold mb-4">Built for Your Team</h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Role-based access ensures everyone has the right tools for their job.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                <!-- Admin Role -->
                <div class="relative p-6 lg:p-8 bg-indigo-600 rounded-2xl text-white overflow-hidden group hover:shadow-2xl hover:shadow-indigo-500/25 transition-all duration-300">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -translate-y-20 translate-x-20 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-5">
                            <span class="material-symbols-outlined text-2xl">admin_panel_settings</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Administrator</h3>
                        <p class="text-indigo-100 mb-5 text-sm leading-relaxed">
                            Full system oversight with access to all documents across the organization.
                        </p>
                        <ul class="space-y-2.5">
                            <li class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-base text-indigo-200">check_circle</span>
                                <span class="text-sm">View all system documents</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-base text-indigo-200">check_circle</span>
                                <span class="text-sm">Global incoming & outgoing tracking</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-base text-indigo-200">check_circle</span>
                                <span class="text-sm">Manage archive & pending documents</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Employee Role -->
                <div class="relative p-6 lg:p-8 bg-emerald-600 rounded-2xl text-white overflow-hidden group hover:shadow-2xl hover:shadow-emerald-500/25 transition-all duration-300">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -translate-y-20 translate-x-20 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-5">
                            <span class="material-symbols-outlined text-2xl">person</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Employee</h3>
                        <p class="text-emerald-100 mb-5 text-sm leading-relaxed">
                            Personal workspace to manage your own documents and assigned tasks.
                        </p>
                        <ul class="space-y-2.5">
                            <li class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-base text-emerald-200">check_circle</span>
                                <span class="text-sm">Compose & send documents</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-base text-emerald-200">check_circle</span>
                                <span class="text-sm">Track personal incoming & outgoing</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-base text-emerald-200">check_circle</span>
                                <span class="text-sm">View assigned actions & deadlines</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-6 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700" role="contentinfo">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 dark:text-gray-500 text-sm">
                    &copy; {{ date('Y') }} DocTrack. All rights reserved.
                </p>
                <a href="#" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors" aria-label="Back to top" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
                    <span class="material-symbols-outlined">arrow_upward</span>
                </a>
            </div>
        </div>
    </footer>

</body>
</html>
