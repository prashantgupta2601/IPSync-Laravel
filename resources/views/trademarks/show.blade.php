<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <span>Trademark Details</span>
            <a href="{{ route('trademarks.index') }}" class="text-sm font-medium text-gray-400 hover:text-white">← Back to List</a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6 md:p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-2">{{ $trademark->name }}</h2>
                        <p class="text-gray-400 text-sm">Submitted on {{ \Carbon\Carbon::parse($trademark->created_at)->format('F j, Y') }}</p>
                    </div>
                    <div>
                        @if($trademark->status === 'pending')
                            <span class="px-3 py-1.5 bg-yellow-400/10 text-yellow-400 text-sm font-medium rounded-full border border-yellow-400/20">Pending</span>
                        @elseif($trademark->status === 'under_review')
                            <span class="px-3 py-1.5 bg-blue-400/10 text-blue-400 text-sm font-medium rounded-full border border-blue-400/20">Under Review</span>
                        @elseif($trademark->status === 'approved')
                            <span class="px-3 py-1.5 bg-[#C4B5FD]/10 text-[#C4B5FD] text-sm font-medium rounded-full border border-[#C4B5FD]/20">Approved</span>
                        @elseif($trademark->status === 'rejected')
                            <span class="px-3 py-1.5 bg-red-400/10 text-red-400 text-sm font-medium rounded-full border border-red-400/20">Rejected</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 p-4 bg-black rounded-lg border border-white/5">
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Owner</h4>
                        <p class="text-gray-200">{{ $trademark->owner_name }}</p>
                    </div>
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Category</h4>
                        <p class="text-gray-200">{{ $trademark->category }}</p>
                    </div>
                </div>

                <div class="prose prose-invert max-w-none">
                    <h4 class="text-sm font-semibold text-gray-300 uppercase tracking-wider mb-3">Description</h4>
                    <p class="text-gray-400 leading-relaxed whitespace-pre-line">{{ $trademark->description }}</p>
                </div>
            </div>

            <!-- Documents -->
            <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Attached Documents</h3>
                @if($trademark->documents->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($trademark->documents as $doc)
                            <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="flex items-center gap-3 p-4 bg-black border border-white/5 hover:border-white/20 rounded-lg group transition-colors">
                                <div class="w-10 h-10 rounded bg-white/5 flex items-center justify-center text-gray-400 group-hover:text-[#C4B5FD]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-sm font-medium text-gray-200 truncate">{{ $doc->original_name }}</p>
                                    <p class="text-xs text-gray-500 uppercase">{{ $doc->type }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">No documents attached.</p>
                @endif
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-6">
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'expert')
            <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Admin Actions</h3>
                <form action="{{ route('trademarks.update', $trademark->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Update Status</label>
                        <select name="status" class="w-full bg-black border border-white/10 rounded-lg text-gray-200 focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD] px-3 py-2">
                            <option value="pending" {{ $trademark->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="under_review" {{ $trademark->status === 'under_review' ? 'selected' : '' }}>Under Review</option>
                            <option value="approved" {{ $trademark->status === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $trademark->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="w-full bg-white/10 hover:bg-white/20 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                        Save Changes
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
