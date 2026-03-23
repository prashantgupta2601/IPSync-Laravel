<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <span class="text-xl font-bold text-white tracking-tight">Roles & Permissions</span>
                <p class="text-sm text-gray-400 mt-1">Manage team access profiles and dynamic permissions.</p>
            </div>
            <a href="{{ route('roles.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-black bg-[#C4B5FD] hover:bg-[#A78BFA] rounded-md transition-all shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Create Role
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($roles as $role)
        <div class="bg-[#0A0A0A] rounded-xl border border-white/10 p-6 flex flex-col hover:border-white/20 transition-all group">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-lg font-bold text-white capitalize">{{ str_replace('-', ' ', $role->name) }}</h3>
                    <p class="text-xs text-gray-500 mt-1">{{ $role->users()->count() }} users assigned</p>
                </div>
                <div class="dropdown relative" x-data="{ open: false }">
                    <button @click="open = !open" class="text-gray-500 hover:text-white transition-colors p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-[#111111] rounded-md shadow-lg border border-white/10 z-10" style="display: none;">
                        <div class="py-1">
                            <a href="{{ route('roles.edit', $role) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white">Edit Role</a>
                            <!-- Exclude Super Admin from deletion -->
                            @if($role->name !== 'super-admin')
                            <form action="{{ route('roles.destroy', $role) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-500 hover:bg-white/5 hover:text-red-400" onclick="return confirm('Are you sure you want to delete this role?')">Delete Role</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 min-w-0">
                <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Assigned Permissions</h4>
                <div class="flex flex-wrap gap-2">
                    @if($role->name === 'super-admin')
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-[#C4B5FD]/10 text-[#C4B5FD] border border-[#C4B5FD]/20">
                            All Permissions Granted
                        </span>
                    @else
                        @forelse($role->permissions->take(6) as $permission)
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-white/5 text-gray-300 border border-white/10 whitespace-nowrap">
                            {{ $permission->name }}
                        </span>
                        @empty
                        <span class="text-sm text-gray-600 italic">No specific permissions</span>
                        @endforelse
                        
                        @if($role->permissions->count() > 6)
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-white/5 text-gray-400 border border-white/10 whitespace-nowrap">
                            +{{ $role->permissions->count() - 6 }} more
                        </span>
                        @endif
                    @endif
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-white/5">
                <a href="{{ route('roles.edit', $role) }}" class="text-sm text-[#C4B5FD] hover:text-[#A78BFA] font-medium flex items-center group-hover:underline">
                    Manage Access
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
