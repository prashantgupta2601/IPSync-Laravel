<x-app-layout>
    <x-slot name="header">
        Welcome back, {{ explode(' ', Auth::user()->name)[0] }} 👋
    </x-slot>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 -->
        <div class="bg-[#0A0A0A] rounded-xl border border-white/5 p-6 shadow-sm hover:shadow-lg hover:border-white/10 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Total Applications</p>
                    <p class="text-3xl font-bold text-white mt-1">248</p>
                </div>
                <div class="w-12 h-12 bg-[#C4B5FD]/10 rounded-full flex items-center justify-center text-[#C4B5FD] border border-[#C4B5FD]/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-emerald-400 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    12%
                </span>
                <span class="text-gray-500 ml-2">vs last month</span>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-[#0A0A0A] rounded-xl border border-white/5 p-6 shadow-sm hover:shadow-lg hover:border-white/10 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Under Review</p>
                    <p class="text-3xl font-bold text-white mt-1">56</p>
                </div>
                <div class="w-12 h-12 bg-amber-500/10 rounded-full flex items-center justify-center text-amber-400 border border-amber-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-amber-400 font-medium">—</span>
                <span class="text-gray-500 ml-2">Awaiting action</span>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-[#0A0A0A] rounded-xl border border-white/5 p-6 shadow-sm hover:shadow-lg hover:border-white/10 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Approved</p>
                    <p class="text-3xl font-bold text-white mt-1">184</p>
                </div>
                <div class="w-12 h-12 bg-emerald-500/10 rounded-full flex items-center justify-center text-emerald-400 border border-emerald-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-emerald-400 font-medium">+4</span>
                <span class="text-gray-500 ml-2">This week</span>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-[#0A0A0A] rounded-xl border border-white/5 p-6 shadow-sm hover:shadow-lg hover:border-white/10 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Upcoming Appointments</p>
                    <p class="text-3xl font-bold text-white mt-1">3</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/10 rounded-full flex items-center justify-center text-blue-400 border border-blue-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <a href="#" class="text-[#C4B5FD] font-medium hover:text-[#E6E6FA]">View calendar &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Activities / Table -->
        <div class="lg:col-span-2 bg-[#0A0A0A] rounded-xl border border-white/5 shadow-sm overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-white/5 flex items-center justify-between">
                <h3 class="font-semibold text-white">Recent Applications</h3>
                <a href="#" class="text-sm text-[#C4B5FD] font-medium hover:text-[#E6E6FA]">View all</a>
            </div>
            <div class="flex-1 overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-400 uppercase bg-[#000000]/50">
                        <tr>
                            <th class="px-6 py-4 font-medium">Application ID</th>
                            <th class="px-6 py-4 font-medium">Title/Type</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <!-- Example Row -->
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-200">APP-2026-089</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-200">Quantum Processor Design</div>
                                <div class="text-xs text-gray-500 mt-0.5">Patent • Utility</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                    Under Review
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="text-[#C4B5FD] hover:text-[#E6E6FA] font-medium">Review</a>
                            </td>
                        </tr>
                        <!-- Example Row -->
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-200">APP-2026-088</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-200">NeuroSync API</div>
                                <div class="text-xs text-gray-500 mt-0.5">Trademark • Technology</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                    Approved
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="text-[#C4B5FD] hover:text-[#E6E6FA] font-medium">Review</a>
                            </td>
                        </tr>
                        <!-- Example Row -->
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-200">APP-2026-085</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-200">Carbon Capture Filter</div>
                                <div class="text-xs text-gray-500 mt-0.5">Patent • Design</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                    Submitted
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="text-[#C4B5FD] hover:text-[#E6E6FA] font-medium">Review</a>
                            </td>
                        </tr>
                        <!-- Example Row -->
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-200">APP-2026-081</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-200">SolarFlow</div>
                                <div class="text-xs text-gray-500 mt-0.5">Trademark • Energy</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-500/10 text-gray-400 border border-gray-500/20">
                                    Draft
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="text-[#C4B5FD] hover:text-[#E6E6FA] font-medium">Resume</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sidebar Widget (Activity Log) -->
        <div class="bg-[#0A0A0A] rounded-xl border border-white/5 shadow-sm flex flex-col">
            <div class="px-6 py-5 border-b border-white/5">
                <h3 class="font-semibold text-white">System Activity</h3>
            </div>
            <div class="px-6 py-5 flex-1 overflow-y-auto">
                <div class="relative border-l border-white/10 ml-3 space-y-6">
                    <!-- Activity Item -->
                    <div class="relative pl-6">
                        <span class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full bg-blue-500 ring-4 ring-[#0A0A0A]"></span>
                        <div class="text-sm">
                            <span class="font-medium text-gray-200">System Notification</span>
                            <span class="text-gray-500 whitespace-nowrap text-xs ml-2">2 hours ago</span>
                        </div>
                        <div class="mt-1 text-sm text-gray-400">Your patent application APP-2026-089 was marked as Under Review.</div>
                    </div>
                    <!-- Activity Item -->
                    <div class="relative pl-6">
                        <span class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full bg-[#C4B5FD]/100 ring-4 ring-[#0A0A0A]"></span>
                        <div class="text-sm">
                            <span class="font-medium text-gray-200">Document Uploaded</span>
                            <span class="text-gray-500 whitespace-nowrap text-xs ml-2">5 hours ago</span>
                        </div>
                        <div class="mt-1 text-sm text-gray-400">Technical_Drawings_v2.pdf added to APP-2026-089.</div>
                    </div>
                    <!-- Activity Item -->
                    <div class="relative pl-6">
                        <span class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full bg-emerald-500 ring-4 ring-[#0A0A0A]"></span>
                        <div class="text-sm">
                            <span class="font-medium text-gray-200">Application Approved</span>
                            <span class="text-gray-500 whitespace-nowrap text-xs ml-2">Yesterday</span>
                        </div>
                        <div class="mt-1 text-sm text-gray-400">Trademark NeuroSync API was officially approved.</div>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-white/5">
                <button class="w-full py-2 px-4 shadow-sm border border-white/10 rounded-lg text-sm font-medium text-gray-300 bg-[#27272a] hover:bg-[#3f3f46] transition-colors">
                    View full activity log
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
