<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-[#C4B5FD]/10 rounded-lg">
                <svg class="w-6 h-6 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <span>AI Similarity Analysis</span>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto mt-4">
        <!-- Search Card -->
        <div class="bg-black border border-white/10 rounded-2xl p-6 md:p-8 relative overflow-hidden shadow-2xl">
            <!-- Decorative gradient -->
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#C4B5FD]/5 rounded-full blur-[100px] pointer-events-none transform translate-x-1/2 -translate-y-1/2"></div>
            
            <div class="relative z-10">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-white mb-2">Check Prior Art & Trademarks</h2>
                    <p class="text-gray-400">Our AI model analyzes millions of existing filings to detect potential overlaps before you submit your application.</p>
                </div>

                <form action="{{ route('ai.similarity.check') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Application Type</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="patent" class="peer sr-only" {{ (isset($search_type) && $search_type === 'patent') || !isset($search_type) ? 'checked' : '' }}>
                                    <div class="p-4 rounded-xl border border-white/10 bg-[#0A0A0A] peer-checked:border-[#C4B5FD] peer-checked:bg-[#C4B5FD]/5 transition-all flex items-center gap-3">
                                        <div class="w-4 h-4 rounded-full border border-gray-500 peer-checked:border-[#C4B5FD] peer-checked:border-[4px] transition-all"></div>
                                        <span class="font-medium text-gray-300 peer-checked:text-white">Patent Design</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="trademark" class="peer sr-only" {{ (isset($search_type) && $search_type === 'trademark') ? 'checked' : '' }}>
                                    <div class="p-4 rounded-xl border border-white/10 bg-[#0A0A0A] peer-checked:border-[#C4B5FD] peer-checked:bg-[#C4B5FD]/5 transition-all flex items-center gap-3">
                                        <div class="w-4 h-4 rounded-full border border-gray-500 peer-checked:border-[#C4B5FD] peer-checked:border-[4px] transition-all"></div>
                                        <span class="font-medium text-gray-300 peer-checked:text-white">Trademark / Logo</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Describe your Idea, Product, or Mark</label>
                        <textarea name="query_text" rows="5" placeholder="E.g., A software system that uses machine learning to automatically track and categorize intellectual property filings across global databases..." required class="w-full bg-[#0A0A0A] border border-white/10 rounded-xl text-gray-200 focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD] p-4 font-mono text-sm leading-relaxed">{{ $query_text ?? old('query_text') }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="group relative px-8 py-3 bg-[#C4B5FD] hover:bg-[#A78BFA] text-black font-bold rounded-xl overflow-hidden shadow-[0_0_20px_rgba(196,181,253,0.3)] transition-all flex items-center gap-2">
                            <span class="relative z-10 hidden group-[.is-loading]:inline-block animate-spin mr-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            </span>
                            <span class="relative z-10 flex items-center gap-2 group-[.is-loading]:hidden">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                Run AI Analysis
                            </span>
                            <div class="absolute inset-0 h-full w-full scale-0 rounded-xl transition-all duration-300 group-hover:scale-100 group-hover:bg-white/20"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results Section -->
        @if(isset($results))
            <div class="mt-8 animate-[fadeIn_0.5s_ease-out]">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-white">Analysis Results</h3>
                    <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs font-medium text-gray-400 font-mono">Found {{ count($results) }} matches</span>
                </div>

                @if(count($results) > 0)
                    <div class="space-y-4">
                        @foreach($results as $result)
                            @php
                                $scoreColor = $result['similarity_score'] >= 70 ? 'text-red-400 bg-red-400/10 border-red-400/20' : 
                                             ($result['similarity_score'] >= 40 ? 'text-yellow-400 bg-yellow-400/10 border-yellow-400/20' : 
                                              'text-green-400 bg-green-400/10 border-green-400/20');
                                $barColor = $result['similarity_score'] >= 70 ? 'bg-red-400' : 
                                             ($result['similarity_score'] >= 40 ? 'bg-yellow-400' : 'bg-green-400');
                            @endphp
                            
                            <div class="bg-[#0A0A0A] border border-white/5 hover:border-white/20 rounded-xl p-6 transition-colors">
                                <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">{{ $result['type'] }} #{{ $result['id'] }}</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-600"></span>
                                            <span class="text-xs font-medium text-gray-400 capitalize">{{ $result['status'] }}</span>
                                        </div>
                                        <h4 class="text-lg font-bold text-white mb-2">{{ $result['title'] }}</h4>
                                        <p class="text-sm text-gray-400 leading-relaxed">{{ $result['abstract'] }}</p>
                                    </div>
                                    
                                    <div class="flex flex-col items-end shrink-0 min-w-[120px]">
                                        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Similarity</div>
                                        <div class="px-4 py-2 rounded-lg border {{ $scoreColor }} font-mono text-xl font-bold mb-3">
                                            {{ $result['similarity_score'] }}%
                                        </div>
                                        <div class="w-full bg-black rounded-full h-1.5 overflow-hidden">
                                            <div class="h-full {{ $barColor }} rounded-full" style="width: {{ $result['similarity_score'] }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-black border border-white/5 rounded-xl p-12 text-center">
                        <div class="w-16 h-16 bg-green-400/10 text-green-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Great news!</h3>
                        <p class="text-gray-400 max-w-md mx-auto">We couldn't find any highly similar records. Your idea appears to be significantly unique based on our current database.</p>
                    </div>
                @endif
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            const btn = this.querySelector('button[type="submit"]');
            btn.classList.add('is-loading');
        });
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @endpush
</x-app-layout>
