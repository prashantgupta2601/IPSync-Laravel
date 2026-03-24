<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#000000]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-200 h-full flex overflow-hidden bg-[#000000] selection:bg-[#C4B5FD]/100 selection:text-white">
        
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-[#000000]">
            <!-- Topbar -->
            @include('layouts.topbar')

            <!-- Page Content -->
            <main class="flex-1 overflow-auto p-4 md:p-6 lg:p-8">
                @isset($header)
                    <header class="mb-6">
                        <div class="text-2xl font-bold leading-tight text-white">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                {{ $slot }}
            </main>
        </div>
        
        <!-- Floating AI Chatbot -->
        <div x-data="{ open: false, messages: [{role: 'bot', text: 'Hi! I am the IPSync AI Assistant. How can I help you with your intellectual property queries today?'}], input: '', isTyping: false }" class="fixed bottom-6 right-6 z-50">
            <!-- Chat Window -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                 class="absolute bottom-16 right-0 w-80 md:w-96 bg-[#000000] border border-[#C4B5FD]/30 rounded-2xl shadow-[0_0_30px_rgba(196,181,253,0.15)] overflow-hidden flex flex-col h-[500px] max-h-[70vh] mb-4" style="display: none;">
                
                <!-- Chat Header -->
                <div class="p-4 bg-gradient-to-r from-[#0A0A0A] to-[#1A1A1A] border-b border-white/10 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="relative w-8 h-8 bg-gradient-to-tr from-[#C4B5FD] to-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-white text-sm">IP Assistant AI</h3>
                            <div class="flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                                <span class="text-[10px] text-gray-400 font-medium">Online</span>
                            </div>
                        </div>
                    </div>
                    <button @click="open = false" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Chat Messages -->
                <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-black" id="chat-messages">
                    <template x-for="(msg, index) in messages" :key="index">
                        <div :class="msg.role === 'user' ? 'ml-auto text-right' : 'mr-auto text-left'" class="max-w-[85%]">
                            <div :class="msg.role === 'user' ? 'bg-[#C4B5FD] text-black rounded-tl-2xl rounded-tr-sm rounded-b-2xl' : 'bg-[#1A1A1A] text-gray-200 rounded-tr-2xl rounded-tl-sm rounded-b-2xl border border-white/5'" class="inline-block p-3 text-sm shadow-sm inline-block text-left break-words w-full">
                                <span x-text="msg.text"></span>
                            </div>
                        </div>
                    </template>
                    
                    <div x-show="isTyping" class="mr-auto w-16 bg-[#1A1A1A] border border-white/5 rounded-tr-2xl rounded-tl-sm rounded-b-2xl p-3 flex justify-center gap-1.5" style="display: none;">
                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0s"></span>
                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></span>
                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                    </div>
                </div>

                <!-- Chat Input -->
                <div class="p-3 bg-[#0A0A0A] border-t border-white/10">
                    <form @submit.prevent="if(input.trim() !== '') {
                        messages.push({role: 'user', text: input});
                        let currentInput = input;
                        input = '';
                        isTyping = true;
                        setTimeout(() => {
                            $el.querySelector('#chat-messages').scrollTop = $el.querySelector('#chat-messages').scrollHeight;
                        }, 50);
                        setTimeout(() => {
                            isTyping = false;
                            messages.push({role: 'bot', text: 'I understand you are asking about \'' + currentInput + '\'. Since I am a mock AI, I recommend booking an appointment with our IP Experts or using the Similarity Checker for immediate prior art research.'});
                            setTimeout(() => {
                                $el.querySelector('#chat-messages').scrollTop = $el.querySelector('#chat-messages').scrollHeight;
                            }, 50);
                        }, 1200);
                    }" class="relative flex items-center">
                        <input x-model="input" type="text" placeholder="Type your message..." class="w-full bg-black border border-white/10 rounded-full py-2.5 pl-4 pr-12 text-sm text-white focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD]">
                        <button type="submit" class="absolute right-1.5 w-8 h-8 bg-[#C4B5FD] rounded-full flex items-center justify-center text-black hover:bg-[#A78BFA] transition-colors" :class="{'opacity-50 cursor-not-allowed': input.trim() === ''}" :disabled="input.trim() === ''">
                            <svg class="w-4 h-4 translate-x-[1px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Toggle Button -->
            <button @click="open = !open" class="w-14 h-14 bg-gradient-to-tr from-[#C4B5FD] to-blue-500 rounded-full shadow-[0_0_20px_rgba(196,181,253,0.4)] flex items-center justify-center text-black hover:scale-105 transition-transform">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                <svg x-show="open" style="display: none;" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        @stack('scripts')
    </body>
</html>
