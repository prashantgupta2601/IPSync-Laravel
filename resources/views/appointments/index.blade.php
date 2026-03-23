<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <span>Consultation Appointments</span>
            <button class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium bg-[#C4B5FD] text-black font-semibold hover:bg-[#A78BFA] rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Schedule Meeting
            </button>
        </div>
    </x-slot>

    <div class="bg-[#0A0A0A] rounded-xl border border-white/5 shadow-sm overflow-hidden flex flex-col">
        <div class="px-6 py-5 border-b border-white/5 flex items-center justify-between">
            <h3 class="font-semibold text-white">Upcoming Schedule</h3>
        </div>
        
        <div class="flex-1 overflow-x-auto p-12 flex items-center justify-center bg-[#000000]/50">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mt-2 text-sm font-medium text-gray-200">No upcoming appointments</h3>
                <p class="mt-1 text-sm text-gray-500">Schedule a consultation with an IP Expert.</p>
            </div>
        </div>
    </div>
</x-app-layout>
