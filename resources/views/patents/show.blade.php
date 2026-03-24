<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <span>Patent Details</span>
            <a href="{{ route('patents.index') }}" class="text-sm font-medium text-gray-400 hover:text-white">← Back to List</a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6 md:p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-2">{{ $patent->title }}</h2>
                        <p class="text-gray-400 text-sm">Submitted on {{ \Carbon\Carbon::parse($patent->filing_date)->format('F j, Y') }} by <span class="text-gray-200">{{ $patent->user->name }}</span></p>
                    </div>
                    <div>
                        @if($patent->status === 'pending')
                            <span class="px-3 py-1.5 bg-yellow-400/10 text-yellow-400 text-sm font-medium rounded-full border border-yellow-400/20">Pending</span>
                        @elseif($patent->status === 'under_review')
                            <span class="px-3 py-1.5 bg-blue-400/10 text-blue-400 text-sm font-medium rounded-full border border-blue-400/20">Under Review</span>
                        @elseif($patent->status === 'approved')
                            <span class="px-3 py-1.5 bg-[#C4B5FD]/10 text-[#C4B5FD] text-sm font-medium rounded-full border border-[#C4B5FD]/20">Approved</span>
                        @elseif($patent->status === 'rejected')
                            <span class="px-3 py-1.5 bg-red-400/10 text-red-400 text-sm font-medium rounded-full border border-red-400/20">Rejected</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 p-4 bg-black rounded-lg border border-white/5">
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Inventor</h4>
                        <p class="text-gray-200">{{ $patent->inventor_name }}</p>
                    </div>
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Category</h4>
                        <p class="text-gray-200">{{ $patent->category }}</p>
                    </div>
                </div>

                <div class="prose prose-invert max-w-none">
                    <h4 class="text-sm font-semibold text-gray-300 uppercase tracking-wider mb-3">Description</h4>
                    <p class="text-gray-400 leading-relaxed whitespace-pre-line">{{ $patent->description }}</p>
                </div>
            </div>

            <!-- Documents -->
            <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Attached Documents</h3>
                @if($patent->documents->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($patent->documents as $doc)
                            <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="flex items-center gap-3 p-4 bg-black border border-white/5 hover:border-white/20 rounded-lg group transition-colors">
                                <div class="w-10 h-10 rounded bg-white/5 flex items-center justify-center text-gray-400 group-hover:text-[#C4B5FD]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
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

        <!-- Sidebar Actions & Timeline -->
        <div class="space-y-6">
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'expert')
            <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Admin Actions</h3>
                <form action="{{ route('patents.update', $patent->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Update Status</label>
                        <select name="status" class="w-full bg-black border border-white/10 rounded-lg text-gray-200 focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD] px-3 py-2">
                            <option value="pending" {{ $patent->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="under_review" {{ $patent->status === 'under_review' ? 'selected' : '' }}>Under Review</option>
                            <option value="approved" {{ $patent->status === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $patent->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="w-full bg-white/10 hover:bg-white/20 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                        Save Changes
                    </button>
                </form>
            </div>
            @endif

            <!-- Progress Timeline -->
            <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-white mb-6">Application Progress</h3>
                <div class="relative pl-6 border-l-2 border-white/10 space-y-8">
                    <div class="relative">
                        <div class="absolute -left-[31px] w-4 h-4 rounded-full bg-[#C4B5FD] border-4 border-[#0A0A0A]"></div>
                        <h4 class="text-sm font-bold text-gray-200">Submitted</h4>
                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($patent->created_at)->format('M d, Y') }}</p>
                    </div>
                    
                    @php
                        $isReview = in_array($patent->status, ['under_review', 'approved', 'rejected']);
                        $isDecided = in_array($patent->status, ['approved', 'rejected']);
                    @endphp

                    <div class="relative">
                        <div class="absolute -left-[31px] w-4 h-4 rounded-full {{ $isReview ? 'bg-[#C4B5FD]' : 'bg-gray-700' }} border-4 border-[#0A0A0A]"></div>
                        <h4 class="text-sm font-bold {{ $isReview ? 'text-gray-200' : 'text-gray-500' }}">Under Review</h4>
                    </div>

                    <div class="relative">
                        <div class="absolute -left-[31px] w-4 h-4 rounded-full {{ $isDecided ? ($patent->status === 'approved' ? 'bg-[#C4B5FD]' : 'bg-red-500') : 'bg-gray-700' }} border-4 border-[#0A0A0A]"></div>
                        <h4 class="text-sm font-bold {{ $isDecided ? 'text-gray-200' : 'text-gray-500' }}">Decision</h4>
                        @if($isDecided)
                            <p class="text-xs {{ $patent->status === 'approved' ? 'text-[#C4B5FD]' : 'text-red-400' }} mt-1 capitalize">{{ $patent->status }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
