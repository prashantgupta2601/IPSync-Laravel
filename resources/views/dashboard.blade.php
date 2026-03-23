<x-app-layout>
    <x-slot name="header">
        Welcome back, {{ explode(' ', Auth::user()->name)[0] }} 👋
    </x-slot>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 -->
        <div class="bg-[#0A0A0A] rounded-xl border border-white/10 p-6 shadow-sm hover:border-[#C4B5FD]/50 transition-all">
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
                    24%
                </span>
                <span class="text-gray-500 ml-2">vs last month</span>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-[#0A0A0A] rounded-xl border border-white/10 p-6 shadow-sm hover:border-[#C4B5FD]/50 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Approval Rate</p>
                    <p class="text-3xl font-bold text-white mt-1">78.2%</p>
                </div>
                <div class="w-12 h-12 bg-emerald-500/10 rounded-full flex items-center justify-center text-emerald-400 border border-emerald-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-emerald-400 font-medium">+4.1%</span>
                <span class="text-gray-500 ml-2">Improved workflow</span>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-[#0A0A0A] rounded-xl border border-white/10 p-6 shadow-sm hover:border-[#C4B5FD]/50 transition-all">
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
                <span class="text-gray-500 ml-2">Awaiting decision</span>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-[#0A0A0A] rounded-xl border border-white/10 p-6 shadow-sm hover:border-[#C4B5FD]/50 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Total Trademarks</p>
                    <p class="text-3xl font-bold text-white mt-1">112</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/10 rounded-full flex items-center justify-center text-blue-400 border border-blue-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-emerald-400 font-medium">+12%</span>
                <span class="text-gray-500 ml-2">This quarter</span>
            </div>
        </div>
    </div>

    <!-- Analytics Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Growth Chart -->
        <div class="lg:col-span-2 bg-[#0A0A0A] rounded-xl border border-white/10 shadow-sm p-6">
            <h3 class="font-semibold text-white mb-4">Monthly Application Growth</h3>
            <div class="relative h-72 w-full">
                <canvas id="growthChart"></canvas>
            </div>
        </div>

        <!-- Distribution Doughnut -->
        <div class="bg-[#0A0A0A] rounded-xl border border-white/10 shadow-sm p-6 flex flex-col">
            <h3 class="font-semibold text-white mb-4">Status Distribution</h3>
            <div class="relative flex-1 w-full flex items-center justify-center">
                <canvas id="statusChart"></canvas>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-4 text-center">
                <div>
                    <p class="text-2xl font-bold text-[#C4B5FD]">184</p>
                    <p class="text-xs text-gray-500 uppercase">Approved</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-amber-500">56</p>
                    <p class="text-xs text-gray-500 uppercase">Pending</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Activities / Table -->
        <div class="lg:col-span-2 bg-[#0A0A0A] rounded-xl border border-white/10 shadow-sm overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-white/10 flex items-center justify-between">
                <h3 class="font-semibold text-white">Recent Applications</h3>
                <a href="{{ route('patents.index') }}" class="text-sm text-[#C4B5FD] font-medium hover:text-[#A78BFA]">View all</a>
            </div>
            <div class="flex-1 overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-400 uppercase bg-[#111111]">
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
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-500/10 text-amber-500 border border-amber-500/20">
                                    Under Review
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="text-[#C4B5FD] hover:text-[#A78BFA] font-medium border border-[#C4B5FD]/20 px-3 py-1 rounded-md bg-[#C4B5FD]/10">Review</a>
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
                                <a href="#" class="text-[#C4B5FD] hover:text-[#A78BFA] font-medium border border-[#C4B5FD]/20 px-3 py-1 rounded-md bg-[#C4B5FD]/10">Review</a>
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
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-500/20 text-gray-400 border border-gray-500/30">
                                    Draft
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="text-gray-400 hover:text-white font-medium border border-gray-600 px-3 py-1 rounded-md bg-gray-800/50">Resume</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sidebar Widget (Activity Log) -->
        <div class="bg-[#0A0A0A] rounded-xl border border-white/10 shadow-sm flex flex-col">
            <div class="px-6 py-5 border-b border-white/10">
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
                        <span class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full bg-[#C4B5FD] ring-4 ring-[#0A0A0A]"></span>
                        <div class="text-sm">
                            <span class="font-medium text-gray-200">Document Uploaded</span>
                            <span class="text-gray-500 whitespace-nowrap text-xs ml-2">5 hours ago</span>
                        </div>
                        <div class="mt-1 text-sm text-gray-400">Technical_Drawings_v2.pdf added to APP-2026-089.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart Defaults for Dark Theme
            Chart.defaults.color = '#9ca3af';
            Chart.defaults.font.family = '"Inter", sans-serif';

            // 1. Monthly Growth Chart (Line & Bar Mix)
            const ctxGrowth = document.getElementById('growthChart').getContext('2d');
            
            // Create Gradient
            const gradient = ctxGrowth.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(196, 181, 253, 0.4)'); // Lavender
            gradient.addColorStop(1, 'rgba(196, 181, 253, 0)');

            new Chart(ctxGrowth, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Patents Filed',
                        data: [12, 19, 15, 25, 22, 30, 28, 35, 40, 38, 45, 50],
                        borderColor: '#C4B5FD',
                        backgroundColor: gradient,
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#C4B5FD',
                        pointBorderColor: '#000000',
                        pointHoverBackgroundColor: '#ffffff',
                        pointHoverBorderColor: '#C4B5FD',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#111111',
                            titleColor: '#ffffff',
                            bodyColor: '#e5e7eb',
                            borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1,
                            padding: 10,
                            displayColors: false,
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false, drawBorder: false },
                        },
                        y: {
                            grid: { color: 'rgba(255,255,255,0.05)', drawBorder: false },
                            beginAtZero: true
                        }
                    }
                }
            });

            // 2. Status Distribution (Doughnut)
            const ctxStatus = document.getElementById('statusChart').getContext('2d');
            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: ['Approved', 'Pending', 'Rejected', 'Draft'],
                    datasets: [{
                        data: [65, 20, 5, 10],
                        backgroundColor: [
                            '#C4B5FD', // Lavender / Approved
                            '#f59e0b', // Amber / Pending
                            '#ef4444', // Red / Rejected
                            '#374151', // Gray / Draft
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#111111',
                            titleColor: '#ffffff',
                            bodyColor: '#e5e7eb',
                            borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1,
                            padding: 10
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
