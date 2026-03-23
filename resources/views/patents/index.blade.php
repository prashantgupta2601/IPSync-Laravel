<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <span>Patent Applications</span>
            @if(auth()->user()->role === 'client')
            <a href="{{ route('patents.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Application
            </a>
            @endif
        </div>
    </x-slot>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-900">All Patents</h3>
            
            <!-- Filters & Search placeholder -->
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input type="text" class="block w-64 pl-10 pr-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50 focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="Search titles...">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Table Placeholder -->
        <div class="flex-1 overflow-x-auto p-12 flex items-center justify-center bg-gray-50/50">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No patents found</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new patent application.</p>
            </div>
        </div>
    </div>
</x-app-layout>
