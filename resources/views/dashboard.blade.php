<x-app-layout>
    <x-slot name="header">
        @if($data['role'] === 'admin')
            Admin Dashboard
        @elseif($data['role'] === 'expert')
            Expert Dashboard
        @else
            Client Dashboard
        @endif
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 mt-4">
        <!-- Total Patents -->
        <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6 flex flex-col justify-center transition-transform hover:-translate-y-1 duration-300">
            <h4 class="text-sm font-medium text-gray-400 mb-1">Total Patents</h4>
            <div class="text-4xl font-bold text-white">{{ $data['total_patents'] }}</div>
        </div>
        <!-- Pending -->
        <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6 flex flex-col justify-center transition-transform hover:-translate-y-1 duration-300">
            <h4 class="text-sm font-medium text-gray-400 mb-1">Pending</h4>
            <div class="text-4xl font-bold text-yellow-400">{{ $data['pending_patents'] }}</div>
        </div>
        <!-- Approved -->
        <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6 flex flex-col justify-center transition-transform hover:-translate-y-1 duration-300">
            <h4 class="text-sm font-medium text-gray-400 mb-1">Approved</h4>
            <div class="text-4xl font-bold text-[#C4B5FD]">{{ $data['approved_patents'] }}</div>
        </div>
        <!-- Rejected -->
        <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6 flex flex-col justify-center transition-transform hover:-translate-y-1 duration-300">
            <h4 class="text-sm font-medium text-gray-400 mb-1">Rejected</h4>
            <div class="text-4xl font-bold text-red-500">{{ $data['rejected_patents'] }}</div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-[#0A0A0A] border border-white/10 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-6">Application Analytics</h3>
        <div class="relative h-72 w-full">
            <canvas id="dashboardChart"></canvas>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('dashboardChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Total', 'Pending', 'Approved', 'Rejected'],
                    datasets: [{
                        label: 'Applications',
                        data: [
                            {{ $data['total_patents'] }},
                            {{ $data['pending_patents'] }},
                            {{ $data['approved_patents'] }},
                            {{ $data['rejected_patents'] }}
                        ],
                        backgroundColor: [
                            'rgba(255, 255, 255, 0.9)',
                            'rgba(250, 204, 21, 0.9)',
                            'rgba(196, 181, 253, 0.9)',
                            'rgba(239, 68, 68, 0.9)'
                        ],
                        borderRadius: 4,
                        maxBarThickness: 50
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(255, 255, 255, 0.05)' },
                            ticks: { 
                                stepSize: 1,
                                color: '#9CA3AF' 
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#9CA3AF' }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
