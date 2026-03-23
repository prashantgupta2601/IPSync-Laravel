<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'IPSync') }} - Intellectual Property Management</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            @keyframes fade-in-up {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in-up { animation: fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
            .delay-100 { animation-delay: 100ms; }
            .delay-200 { animation-delay: 200ms; }
            .delay-300 { animation-delay: 300ms; }
            .glassmorphism {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.5);
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900 bg-[#FAFAFA] dark:bg-[#000000] dark:text-gray-100 selection:bg-[#C4B5FD]/100 selection:text-white">
        
        <!-- Navigation -->
        <nav class="fixed w-full z-50 glassmorphism dark:bg-[#000000]/80 border-b border-gray-200/50 dark:border-gray-800/50 transition-all">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <svg class="w-8 h-8 text-[#C4B5FD] dark:text-[#C4B5FD]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4ZM11 11H7V13H11V17H13V13H17V11H13V7H11V11Z"></path></svg>
                        <span class="font-bold text-2xl tracking-tight">IP<span class="text-[#C4B5FD] dark:text-[#C4B5FD]">Sync</span></span>
                    </div>
                    <div class="hidden md:flex space-x-8 items-center">
                        <a href="#features" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors">Features</a>
                        <a href="#testimonials" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors">Testimonials</a>
                        <a href="#pricing" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors">Pricing</a>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-200 transition-colors">Go to Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-300 transition-colors">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium bg-[#C4B5FD] text-black font-semibold hover:bg-[#A78BFA] rounded-full transition-all hover:shadow-lg hover:shadow-indigo-500/30 transform hover:-translate-y-0.5">Start for free</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden items-center flex min-h-screen">
            <!-- Background Elements -->
            <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-[#C4B5FD]/20 via-transparent to-transparent dark:from-indigo-900/20 dark:via-transparent dark:to-transparent opacity-70"></div>
            <div class="absolute top-1/4 -left-1/4 w-96 h-96 bg-purple-300/30 dark:bg-purple-900/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
            <div class="absolute top-1/3 -right-1/4 w-96 h-96 bg-indigo-300/30 dark:bg-indigo-900/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
                <div class="mx-auto max-w-3xl animate-fade-in-up opacity-0">
                    <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-gray-900 dark:text-white leading-[1.1] mb-6">
                        Protect your ideas with <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#C4B5FD] to-[#A78BFA] dark:from-[#C4B5FD] dark:to-[#E6E6FA]">confident speed.</span>
                    </h1>
                    <p class="text-lg lg:text-xl text-gray-600 dark:text-gray-400 mb-10 max-w-2xl mx-auto leading-relaxed">
                        The unified gateway for patent and trademark applications. Automatically track status, securely store documents, and consult with leading IP experts on a premium platform built for modern inventors.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex w-full sm:w-auto items-center justify-center px-8 py-4 text-base font-medium text-white bg-gray-900 hover:bg-gray-800 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 rounded-full transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
                                Submit a Patent File
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        @endif
                        <a href="#features" class="inline-flex w-full sm:w-auto items-center justify-center px-8 py-4 text-base font-medium text-gray-700 bg-white ring-1 ring-inset ring-gray-200 hover:bg-gray-50 dark:bg-[#161615] dark:text-gray-300 dark:ring-gray-800 dark:hover:bg-[#1f1f1d] rounded-full transition-all hover:shadow-lg">
                            See how it works
                        </a>
                    </div>
                    <!-- Trust Indicators -->
                    <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-800/50 flex flex-col items-center">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-4 uppercase tracking-wider">Trusted by top legal firms worldwide</p>
                        <div class="flex gap-8 items-center justify-center opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                            <!-- Placeholder logos -->
                            <div class="text-xl font-bold flex items-center gap-1"><div class="w-6 h-6 bg-[#C4B5FD] text-black font-semibold rounded-sm"></div> Acme Corp</div>
                            <div class="text-xl font-serif font-bold italic">Horizon Legal</div>
                            <div class="text-xl font-bold tracking-tighter">GLOBAL<span class="text-blue-500">IP</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Features Section -->
        <section id="features" class="py-24 bg-white dark:bg-[#0d0d0e]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16 animate-fade-in-up delay-100 opacity-0">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Everything you need to secure your intellectual property</h2>
                    <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Traditional IP management is broken. We streamlined the whole process into one powerful, unified dashboard.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-gray-50 dark:bg-[#161615] rounded-3xl p-8 border border-gray-100 dark:border-gray-800 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-in-up delay-100 opacity-0 group">
                        <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center text-blue-600 dark:text-blue-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Unified Applications</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">Submit utility, design, and trademark applications quickly using our dynamic forms. Monitor live updates at every step.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-gray-50 dark:bg-[#161615] rounded-3xl p-8 border border-gray-100 dark:border-gray-800 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-in-up delay-200 opacity-0 group">
                        <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center text-purple-600 dark:text-purple-400 mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Secure Document Vault</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">End-to-end encrypted storage for sensitive prototypes, NDAs, and technical drawings. Only accessible by authorized experts.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-gray-50 dark:bg-[#161615] rounded-3xl p-8 border border-gray-100 dark:border-gray-800 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-in-up delay-300 opacity-0 group">
                        <div class="w-14 h-14 bg-indigo-100 dark:bg-indigo-900/30 rounded-2xl flex items-center justify-center text-[#C4B5FD] dark:text-[#C4B5FD] mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Expert Networking</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">Instantly schedule appointments with top intellectual property experts. Communicate, ask questions, and refine your patent.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Script for scroll animations -->
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const observerOptions = {
                    root: null,
                    rootMargin: "0px",
                    threshold: 0.1
                };

                const observer = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.replace('opacity-0', 'opacity-100');
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                document.querySelectorAll('.animate-fade-in-up').forEach((elem) => {
                    observer.observe(elem);
                });
            });
        </script>
    </body>
</html>
