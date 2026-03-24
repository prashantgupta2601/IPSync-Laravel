<x-app-layout>
    <x-slot name="header">
        Appointments
    </x-slot>

    <div class="bg-[#0A0A0A] border border-white/10 rounded-xl overflow-hidden mt-4">
        <div class="p-6 border-b border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h3 class="text-lg font-semibold text-white">Your Consultations</h3>
            
            @if(auth()->user()->role === 'client')
            <a href="{{ route('appointments.create') }}" class="bg-[#C4B5FD] hover:bg-[#A78BFA] text-black px-4 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Book Appointment
            </a>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/10 bg-[#000000]">
                        <th class="py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-wider">Date & Time</th>
                        @if(auth()->user()->role !== 'client')
                        <th class="py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-wider">Client</th>
                        @endif
                        @if(auth()->user()->role !== 'expert')
                        <th class="py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-wider">Expert</th>
                        @endif
                        <th class="py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-6 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($appointments as $appointment)
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="py-4 px-6 text-sm text-gray-200 font-medium whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('M d, Y h:i A') }}
                        </td>
                        @if(auth()->user()->role !== 'client')
                        <td class="py-4 px-6 text-sm text-gray-400">{{ $appointment->client->name }}</td>
                        @endif
                        @if(auth()->user()->role !== 'expert')
                        <td class="py-4 px-6 text-sm text-gray-400">{{ $appointment->expert->name }}</td>
                        @endif
                        <td class="py-4 px-6">
                            @if($appointment->status === 'scheduled')
                                <span class="px-2.5 py-1 bg-blue-400/10 text-blue-400 text-xs font-medium rounded-full border border-blue-400/20">Scheduled</span>
                            @elseif($appointment->status === 'completed')
                                <span class="px-2.5 py-1 bg-[#C4B5FD]/10 text-[#C4B5FD] text-xs font-medium rounded-full border border-[#C4B5FD]/20">Completed</span>
                            @elseif($appointment->status === 'cancelled')
                                <span class="px-2.5 py-1 bg-red-400/10 text-red-400 text-xs font-medium rounded-full border border-red-400/20">Cancelled</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{ route('appointments.show', $appointment->id) }}" class="text-gray-400 hover:text-[#C4B5FD] text-sm font-medium transition-colors">Details</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-500 text-sm">No appointments found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($appointments->hasPages())
        <div class="p-4 border-t border-white/10">
            {{ $appointments->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
