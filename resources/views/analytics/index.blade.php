<x-app-layout>
    <x-slot name="header">
        Analytics & Performance
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-4 mb-8">
        <!-- Users Card -->
        <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6 flex items-center justify-between">
            <div>
                <h4 class="text-sm font-medium text-gray-400 mb-1">Total Users</h4>
                <div class="text-3xl font-bold text-white">{{ $stats['total_users'] }}</div>
            </div>
            <div class="w-12 h-12 bg-[#C4B5FD]/10 rounded-lg flex items-center justify-center text-[#C4B5FD]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>

        <!-- Clients Card -->
        <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6 flex items-center justify-between">
            <div>
                <h4 class="text-sm font-medium text-gray-400 mb-1">Total Clients</h4>
                <div class="text-3xl font-bold text-white">{{ $stats['clients'] }}</div>
            </div>
            <div class="w-12 h-12 bg-blue-400/10 rounded-lg flex items-center justify-center text-blue-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
        </div>

        <!-- Approval Rate (Patents) -->
        @php
            $totalPatents = array_sum($stats['patents_by_status'] ?? []);
            $approvedPatents = $stats['patents_by_status']['approved'] ?? 0;
            $patentRate = $totalPatents > 0 ? round(($approvedPatents / $totalPatents) * 100) : 0;
        @endphp
        <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6 flex items-center justify-between">
            <div>
                <h4 class="text-sm font-medium text-gray-400 mb-1">Patent Approval Rate</h4>
                <div class="text-3xl font-bold text-white">{{ $patentRate }}%</div>
            </div>
            <div class="w-12 h-12 bg-green-400/10 rounded-lg flex items-center justify-center text-green-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <!-- Approval Rate (Trademarks) -->
        @php
            $totalTrademarks = array_sum($stats['trademarks_by_status'] ?? []);
            $approvedTrademarks = $stats['trademarks_by_status']['approved'] ?? 0;
            $trademarkRate = $totalTrademarks > 0 ? round(($approvedTrademarks / $totalTrademarks) * 100) : 0;
        @endphp
        <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6 flex items-center justify-between">
            <div>
                <h4 class="text-sm font-medium text-gray-400 mb-1">Trademark Approval Rate</h4>
                <div class="text-3xl font-bold text-white">{{ $trademarkRate }}%</div>
            </div>
            <div class="w-12 h-12 bg-[#C4B5FD]/10 rounded-lg flex items-center justify-center text-[#C4B5FD]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Monthly Filings Chart -->
        <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Applications Over Time</h3>
            <div class="relative h-72 w-full">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>

        <!-- Status Distribution Chart -->
        <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Status Distribution (Patents)</h3>
            <div class="relative h-72 w-full flex justify-center">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup default font color
            Chart.defaults.color = '#9CA3AF';
            
            // Monthly Line Chart
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [
                        {
                            label: 'Patents',
                            data: {!! json_encode(array_values($monthlyPatents)) !!},
                            borderColor: '#C4B5FD',
                            backgroundColor: 'rgba(196, 181, 253, 0.1)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Trademarks',
                            data: {!! json_encode(array_values($monthlyTrademarks)) !!},
                            borderColor: '#60A5FA',
                            backgroundColor: 'rgba(96, 165, 250, 0.1)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 8 } }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(255,255,255,0.05)' },
                            ticks: { stepSize: 1 }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });

            // Status Doughnut Chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Under Review', 'Approved', 'Rejected'],
                    datasets: [{
                        data: [
                            {{ $stats['patents_by_status']['pending'] ?? 0 }},
                            {{ $stats['patents_by_status']['under_review'] ?? 0 }},
                            {{ $stats['patents_by_status']['approved'] ?? 0 }},
                            {{ $stats['patents_by_status']['rejected'] ?? 0 }}
                        ],
                        backgroundColor: [
                            'rgba(250, 204, 21, 0.8)',
                            'rgba(96, 165, 250, 0.8)',
                            'rgba(196, 181, 253, 0.8)',
                            'rgba(239, 68, 68, 0.8)'
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
                        legend: { position: 'right', labels: { usePointStyle: true, padding: 20 } }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
