<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <span>Trademark Applications</span>
            @if(auth()->user()->role === 'client')
            <button class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium bg-[#C4B5FD] text-black font-semibold hover:bg-[#A78BFA] rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Trademark
            </button>
            @endif
        </div>
    </x-slot>

    <div class="bg-[#0A0A0A] rounded-xl border border-white/5 shadow-sm overflow-hidden flex flex-col">
        <div class="px-6 py-5 border-b border-white/5 flex items-center justify-between">
            <h3 class="font-semibold text-white">All Trademarks</h3>
        </div>
        
        <div class="flex-1 overflow-x-auto p-12 flex items-center justify-center bg-[#000000]/50">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <h3 class="mt-2 text-sm font-medium text-gray-200">No trademarks found</h3>
                <p class="mt-1 text-sm text-gray-500">Protect your brand identity by filing a trademark.</p>
            </div>
        </div>
    </div>
</x-app-layout>
