<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <span class="text-xl font-bold text-white tracking-tight">System Reports</span>
                <p class="text-sm text-gray-400 mt-1">Generate, view, and export detailed application and user data.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <button class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-gray-200 bg-[#0A0A0A] border border-white/10 hover:border-white/20 hover:bg-[#111111] rounded-md transition-all shadow-sm">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export CSV
                </button>
                <button class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-black bg-[#C4B5FD] hover:bg-[#A78BFA] rounded-md transition-all shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Export PDF
                </button>
            </div>
        </div>
    </x-slot>

    <div class="bg-[#0A0A0A] rounded-xl border border-white/10 shadow-sm overflow-hidden flex flex-col min-h-[600px]">
        
        <!-- Controls -->
        <div class="px-6 py-5 border-b border-white/10 flex flex-wrap items-center justify-between gap-4 bg-[#000000]">
            <div class="flex items-center gap-3">
                <select class="bg-[#111111] text-gray-200 border-white/10 rounded-lg text-sm focus:ring-[#C4B5FD] focus:border-[#C4B5FD]">
                    <option>All Applications</option>
                    <option>Patents Only</option>
                    <option>Trademarks Only</option>
                    <option>Active Users</option>
                </select>
                
                <div class="flex items-center gap-2 border border-white/10 rounded-lg bg-[#111111] px-3 py-2">
                    <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-sm text-gray-300">Last 30 Days</span>
                </div>
            </div>

            <div class="relative w-64">
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-white/10 rounded-lg text-sm bg-[#111111] text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-[#C4B5FD]" placeholder="Search records...">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
        </div>
        
        <!-- Massive Data Table -->
        <div class="flex-1 overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-400 uppercase bg-[#070707] border-b border-white/5">
                    <tr>
                        <th class="px-6 py-4 font-semibold tracking-wider">Date</th>
                        <th class="px-6 py-4 font-semibold tracking-wider">Reference ID</th>
                        <th class="px-6 py-4 font-semibold tracking-wider">Client / Entity</th>
                        <th class="px-6 py-4 font-semibold tracking-wider">Type</th>
                        <th class="px-6 py-4 font-semibold tracking-wider">Current Status</th>
                        <th class="px-6 py-4 font-semibold tracking-wider text-right">Fee Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 bg-[#0A0A0A]">
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 text-gray-400">2026-03-24</td>
                        <td class="px-6 py-4 font-mono text-[#C4B5FD]">APP-89472</td>
                        <td class="px-6 py-4 text-gray-200 font-medium">Nexus Dynamics LLC</td>
                        <td class="px-6 py-4 text-gray-300">Patent (Utility)</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Approved</span>
                        </td>
                        <td class="px-6 py-4 text-right text-gray-300">Paid ($450.00)</td>
                    </tr>
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 text-gray-400">2026-03-23</td>
                        <td class="px-6 py-4 font-mono text-[#C4B5FD]">APP-89471</td>
                        <td class="px-6 py-4 text-gray-200 font-medium">BioGenix Labs</td>
                        <td class="px-6 py-4 text-gray-300">Trademark</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-500/10 text-amber-500 border border-amber-500/20">Under Review</span>
                        </td>
                        <td class="px-6 py-4 text-right text-gray-300">Pending</td>
                    </tr>
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 text-gray-400">2026-03-22</td>
                        <td class="px-6 py-4 font-mono text-[#C4B5FD]">APP-89470</td>
                        <td class="px-6 py-4 text-gray-200 font-medium">Starlight Ventures</td>
                        <td class="px-6 py-4 text-gray-300">Patent (Design)</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-500/20 text-gray-400 border border-gray-500/30">Draft</span>
                        </td>
                        <td class="px-6 py-4 text-right text-gray-300">—</td>
                    </tr>
                    <!-- Pagination spacer -->
                    <tr><td colspan="6" class="p-8"></td></tr>
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-white/10 bg-[#000000] flex justify-between items-center text-sm text-gray-400">
            <span>Showing 1 to 10 of 2,492 entries</span>
            <div class="flex space-x-2">
                <button class="px-3 py-1 border border-white/10 rounded hover:bg-white/5 cursor-not-allowed opacity-50">Previous</button>
                <button class="px-3 py-1 border border-white/10 rounded bg-[#C4B5FD]/10 text-[#C4B5FD]">1</button>
                <button class="px-3 py-1 border border-white/10 rounded hover:bg-white/5">2</button>
                <button class="px-3 py-1 border border-white/10 rounded hover:bg-white/5">3</button>
                <button class="px-3 py-1 border border-white/10 rounded hover:bg-white/5">Next</button>
            </div>
        </div>
    </div>
</x-app-layout>
