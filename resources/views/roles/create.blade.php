<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('roles.index') }}" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <span class="text-xl font-bold text-white tracking-tight">Create New Role</span>
                <p class="text-sm text-gray-400 mt-1">Define completely custom access levels for your team.</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-[#0A0A0A] rounded-xl border border-white/10 p-8 shadow-sm max-w-5xl mx-auto">
        <form action="{{ route('roles.store') }}" method="POST" class="space-y-8">
            @csrf
            
            <!-- Role Name -->
            <div class="max-w-md">
                <label class="block text-sm font-medium text-gray-200 mb-2">Role Overview</label>
                <div class="mt-1">
                    <input type="text" name="name" required class="w-full bg-[#000000] text-white border-white/10 rounded-lg shadow-sm focus:ring-[#C4B5FD] focus:border-[#C4B5FD] sm:text-sm px-4 py-2" placeholder="e.g. Legal Editor">
                </div>
                <p class="mt-2 text-xs text-gray-500">Provide a unique, descriptive name for this role.</p>
            </div>

            <div class="border-t border-white/10 pt-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-200">System Permissions</h3>
                        <p class="text-xs text-gray-500 mt-1">Select the exact permissions to attach to this role.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($permissions as $permission)
                    <label class="relative flex items-start p-4 cursor-pointer rounded-lg border border-white/5 bg-[#000000] hover:bg-white/5 transition-colors focus-within:ring-2 focus-within:ring-[#C4B5FD]">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="w-4 h-4 text-[#C4B5FD] bg-[#111111] border-gray-600 rounded focus:ring-[#C4B5FD] focus:ring-offset-[#0A0A0A]">
                        </div>
                        <div class="ml-3 text-sm">
                            <span class="font-medium text-gray-200 capitalize">{{ str_replace('-', ' ', $permission->name) }}</span>
                            <p class="text-xs text-gray-500 mt-0.5">Allow user to {{ str_replace('manage', 'manage all', $permission->name) }}.</p>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-6 border-t border-white/10 flex justify-end gap-3">
                <a href="{{ route('roles.index') }}" class="px-5 py-2 border border-white/10 shadow-sm text-sm font-medium rounded-lg text-gray-300 bg-[#111111] hover:bg-[#1f1f1f]">Cancel</a>
                <button type="submit" class="px-6 py-2 shadow-sm text-sm font-semibold rounded-lg text-black bg-[#C4B5FD] hover:bg-[#A78BFA] transition-colors">Create & Assign Role</button>
            </div>
        </form>
    </div>
</x-app-layout>
