<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <span class="text-xl font-bold text-white tracking-tight">Deep Analytics</span>
                <p class="text-sm text-gray-400 mt-1">Cross-sectional intelligence across the entire IP ecosystem.</p>
            </div>
        </div>
    </x-slot>

    <!-- Analytics Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        
        <!-- Geographic Distribution (Bar Chart) -->
        <div class="bg-[#0A0A0A] rounded-xl border border-white/10 shadow-sm p-6">
            <h3 class="font-semibold text-white mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Filing Demographics (Regions)
            </h3>
            <div class="relative h-80 w-full">
                <canvas id="geoChart"></canvas>
            </div>
        </div>

        <!-- Radar Chart for Application Complexities -->
        <div class="bg-[#0A0A0A] rounded-xl border border-white/10 shadow-sm p-6">
            <h3 class="font-semibold text-white mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-[#A78BFA]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                Sector Distribution
            </h3>
            <div class="relative h-80 w-full flex items-center justify-center">
                <canvas id="radarChart"></canvas>
            </div>
        </div>

        <!-- Full Width Line Chart: Revenue / Fees Processed -->
        <div class="lg:col-span-2 bg-[#0A0A0A] rounded-xl border border-white/10 shadow-sm p-6">
            <h3 class="font-semibold text-white mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Processing Fees Revenue (YTD)
            </h3>
            <div class="relative h-72 w-full">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

    </div>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Chart.defaults.color = '#9ca3af';
            Chart.defaults.font.family = '"Inter", sans-serif';
            Chart.defaults.borderColor = 'rgba(255,255,255,0.05)';

            // 1. Bar Chart
            const ctxGeo = document.getElementById('geoChart').getContext('2d');
            new Chart(ctxGeo, {
                type: 'bar',
                data: {
                    labels: ['North America', 'Europe', 'Asia Pacific', 'Latin America', 'MEA'],
                    datasets: [{
                        label: 'Filings',
                        data: [420, 250, 380, 110, 80],
                        backgroundColor: '#C4B5FD',
                        borderRadius: 4,
                        hoverBackgroundColor: '#A78BFA'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true }
                    }
                }
            });

            // 2. Radar Chart
            const ctxRadar = document.getElementById('radarChart').getContext('2d');
            new Chart(ctxRadar, {
                type: 'radar',
                data: {
                    labels: ['Software Tech', 'Biotech', 'Manufacturing', 'Design', 'Consumer Goods', 'Energy'],
                    datasets: [
                        {
                            label: 'Patents',
                            data: [85, 70, 60, 40, 90, 50],
                            backgroundColor: 'rgba(196, 181, 253, 0.2)',
                            borderColor: '#C4B5FD',
                            pointBackgroundColor: '#C4B5FD',
                        },
                        {
                            label: 'Trademarks',
                            data: [50, 30, 80, 90, 95, 40],
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderColor: '#10B981', // emerald
                            pointBackgroundColor: '#10B981',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            angleLines: { color: 'rgba(255,255,255,0.1)' },
                            grid: { color: 'rgba(255,255,255,0.1)' },
                            pointLabels: { color: '#e5e7eb' },
                            ticks: { display: false } // hide numbers internally
                        }
                    }
                }
            });

            // 3. Line Chart
            const ctxRev = document.getElementById('revenueChart').getContext('2d');
            const revGradient = ctxRev.createLinearGradient(0, 0, 0, 400);
            revGradient.addColorStop(0, 'rgba(16, 185, 129, 0.3)'); // emerald
            revGradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

            new Chart(ctxRev, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Revenue ($)',
                        data: [12000, 19000, 15000, 25000, 22000, 35000, 31000],
                        borderColor: '#10B981',
                        backgroundColor: revGradient,
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#10B981',
                        pointBorderColor: '#000000'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>
</x-app-layout>
