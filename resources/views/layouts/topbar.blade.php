<header class="bg-[#000000] border-b border-white/5 flex-shrink-0 h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8 z-10">
    <!-- Left Side: Mobile Menu Button & Search -->
    <div class="flex items-center gap-4 flex-1">
        <!-- Mobile menu button -->
        <button class="md:hidden p-2 rounded-md text-gray-400 hover:text-gray-300 hover:bg-white/5 focus:outline-none">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Search Bar -->
        <div class="hidden sm:flex max-w-md w-full relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" class="block w-full pl-10 pr-3 py-2 border border-white/10 rounded-lg leading-5 bg-[#0A0A0A] text-gray-200 placeholder-gray-500 focus:outline-none focus:bg-[#27272a] focus:ring-1 focus:ring-[#C4B5FD] focus:border-[#C4B5FD] sm:text-sm transition-colors" placeholder="Search patents, trademarks, or users...">
        </div>
    </div>

    <!-- Right Side: Profile & Notifications -->
    <div class="flex items-center gap-4">
        <button class="p-2 text-gray-400 hover:text-gray-300 transition-colors relative">
            <span class="absolute top-1 right-1 h-2 w-2 bg-[#C4B5FD]/100 rounded-full border-2 border-[#000000]"></span>
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
        </button>

        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-gray-300 bg-[#0A0A0A] hover:bg-[#27272a] rounded-lg border border-white/5 transition-all focus:outline-none">
                    <div class="w-8 h-8 bg-[#C4B5FD]/20 rounded-full flex items-center justify-center text-[#C4B5FD] font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="hidden sm:block text-left">
                        <div class="text-sm font-medium text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</div>
                    </div>
                    <svg class="fill-current h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="bg-[#0A0A0A] border border-white/10 rounded-md">
                    <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:bg-white/5 hover:text-white">
                        {{ __('Profile Settings') }}
                    </x-dropdown-link>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-400 hover:bg-white/5 hover:text-red-300">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </x-slot>
        </x-dropdown>
    </div>
</header>
