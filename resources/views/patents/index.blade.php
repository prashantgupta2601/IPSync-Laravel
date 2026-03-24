<x-app-layout>
    <x-slot name="header">
        Patent Applications
    </x-slot>

    <div class="bg-[#0A0A0A] border border-white/10 rounded-xl overflow-hidden mt-4">
        <!-- Header & Filters -->
        <div class="p-6 border-b border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h3 class="text-lg font-semibold text-white">All Applications</h3>
            
            <div class="flex items-center gap-3">
                <form action="{{ route('patents.index') }}" method="GET" class="flex items-center gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search patents..." class="bg-black border border-white/10 rounded-lg text-sm text-gray-200 placeholder-gray-500 focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD] px-3 py-2">
                    <select name="status" class="bg-black border border-white/10 rounded-lg text-sm text-gray-200 focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD] px-3 py-2">
                        <option value="all">All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="under_review" {{ request('status') === 'under_review' ? 'selected' : '' }}>Under Review</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit" class="bg-white/5 hover:bg-white/10 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Filter</button>
                </form>

                @if(auth()->user()->role === 'client')
                <a href="{{ route('patents.create') }}" class="bg-[#C4B5FD] hover:bg-[#A78BFA] text-black px-4 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    New Application
                </a>
                @endif
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/10 bg-[#000000]">
                        <th class="py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-wider">Title</th>
                        <th class="py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-wider">Applicant</th>
                        <th class="py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-wider">Category</th>
                        <th class="py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-wider">Filing Date</th>
                        <th class="py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-6 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($patents as $patent)
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="py-4 px-6 text-sm text-gray-200 font-medium">{{ $patent->title }}</td>
                        <td class="py-4 px-6 text-sm text-gray-400">{{ $patent->user->name }}</td>
                        <td class="py-4 px-6 text-sm text-gray-400">{{ $patent->category }}</td>
                        <td class="py-4 px-6 text-sm text-gray-400">{{ \Carbon\Carbon::parse($patent->filing_date)->format('M d, Y') }}</td>
                        <td class="py-4 px-6">
                            @if($patent->status === 'pending')
                                <span class="px-2.5 py-1 bg-yellow-400/10 text-yellow-400 text-xs font-medium rounded-full border border-yellow-400/20">Pending</span>
                            @elseif($patent->status === 'under_review')
                                <span class="px-2.5 py-1 bg-blue-400/10 text-blue-400 text-xs font-medium rounded-full border border-blue-400/20">Under Review</span>
                            @elseif($patent->status === 'approved')
                                <span class="px-2.5 py-1 bg-[#C4B5FD]/10 text-[#C4B5FD] text-xs font-medium rounded-full border border-[#C4B5FD]/20">Approved</span>
                            @elseif($patent->status === 'rejected')
                                <span class="px-2.5 py-1 bg-red-400/10 text-red-400 text-xs font-medium rounded-full border border-red-400/20">Rejected</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{ route('patents.show', $patent->id) }}" class="text-gray-400 hover:text-[#C4B5FD] text-sm font-medium transition-colors">View Details</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-500 text-sm">No applications found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($patents->hasPages())
        <div class="p-4 border-t border-white/10">
            {{ $patents->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
