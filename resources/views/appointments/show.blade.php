<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <span>Appointment Details</span>
            <a href="{{ route('appointments.index') }}" class="text-sm font-medium text-gray-400 hover:text-white">← Back to List</a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-4">
        <div class="bg-[#0A0A0A] border border-white/10 rounded-xl overflow-hidden shadow-2xl">
            <div class="border-b border-white/10 bg-black/50 p-6 md:p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <svg class="w-32 h-32 text-current" fill="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-2">
                        @if($appointment->status === 'scheduled')
                            <span class="px-3 py-1 bg-blue-500/20 text-blue-400 text-xs font-bold uppercase tracking-wider rounded-md border border-blue-500/20 shadow-[0_0_10px_rgba(59,130,246,0.2)]">Upcoming</span>
                        @elseif($appointment->status === 'completed')
                            <span class="px-3 py-1 bg-[#C4B5FD]/20 text-[#C4B5FD] text-xs font-bold uppercase tracking-wider rounded-md border border-[#C4B5FD]/20 shadow-[0_0_10px_rgba(196,181,253,0.2)]">Completed</span>
                        @else
                            <span class="px-3 py-1 bg-red-500/20 text-red-500 text-xs font-bold uppercase tracking-wider rounded-md border border-red-500/20">Cancelled</span>
                        @endif
                    </div>
                    
                    <h2 class="text-3xl font-extrabold text-white mb-2">{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('l, F j, Y') }}</h2>
                    <p class="text-xl text-[#C4B5FD]">{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('h:i A') }}</p>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="bg-black border border-white/5 rounded-lg p-5">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Client</h4>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white font-bold">
                                {{ substr($appointment->client->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-white font-medium">{{ $appointment->client->name }}</p>
                                <p class="text-sm text-gray-400">{{ $appointment->client->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-black border border-white/5 rounded-lg p-5">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">IP Expert</h4>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#C4B5FD]/20 flex items-center justify-center text-[#C4B5FD] font-bold">
                                {{ substr($appointment->expert->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-white font-medium">{{ $appointment->expert->name }}</p>
                                <p class="text-sm text-gray-400">{{ $appointment->expert->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($appointment->notes)
                <div class="mb-8">
                    <h4 class="text-sm font-bold text-white mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Meeting Notes / Agenda
                    </h4>
                    <div class="bg-black/50 border border-white/5 rounded-lg p-5">
                        <p class="text-gray-300 leading-relaxed whitespace-pre-line">{{ $appointment->notes }}</p>
                    </div>
                </div>
                @endif

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'expert')
                <div class="mt-8 pt-8 border-t border-white/10">
                    <h4 class="text-sm font-bold text-white mb-4">Update Status</h4>
                    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="flex items-center gap-4">
                        @csrf
                        @method('PUT')
                        <select name="status" class="bg-black border border-white/10 rounded-lg text-sm text-gray-200 focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD] px-3 py-2 w-48">
                            <option value="scheduled" {{ $appointment->status === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Save
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
