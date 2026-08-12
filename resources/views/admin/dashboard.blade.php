@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    
    <!-- Header Dashboard -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Dashboard Analytics</h1>
            <p class="text-slate-600 font-bold mt-1">Ringkasan performa tautan Bio-Link Anda.</p>
        </div>
        <a href="{{ route('admin.links.index') }}" class="hidden sm:flex bg-white hover:bg-slate-50 text-slate-900 font-black py-2.5 px-5 rounded-xl border-4 border-slate-900 shadow-[4px_4px_0px_0px_#0f172a] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all items-center gap-2">
            Kelola Tautan <i data-lucide="arrow-right" class="w-5 h-5 stroke-[3]"></i>
        </a>
    </div>

    <!-- 1. SUMMARY CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <!-- Card: Total Tautan -->
        <div class="bg-blue-200 border-4 border-slate-900 rounded-3xl p-6 shadow-[6px_6px_0px_0px_#0f172a] relative overflow-hidden group hover:-translate-y-1 transition-transform">
            <i data-lucide="link" class="w-20 h-20 text-blue-300 absolute -bottom-4 -right-4 stroke-[3] group-hover:scale-110 transition-transform"></i>
            <h3 class="text-sm font-black text-slate-700 uppercase tracking-widest mb-2 relative z-10">Total Tautan</h3>
            <div class="flex items-baseline gap-2 relative z-10">
                <span class="text-5xl font-black text-slate-900">{{ $totalLinks }}</span>
                <span class="text-sm font-extrabold text-slate-600">({{ $activeLinks }} Aktif)</span>
            </div>
        </div>

        <!-- Card: Total Klik -->
        <div class="bg-emerald-200 border-4 border-slate-900 rounded-3xl p-6 shadow-[6px_6px_0px_0px_#0f172a] relative overflow-hidden group hover:-translate-y-1 transition-transform">
            <i data-lucide="mouse-pointer-click" class="w-20 h-20 text-emerald-300 absolute -bottom-4 -right-4 stroke-[3] group-hover:scale-110 transition-transform"></i>
            <h3 class="text-sm font-black text-slate-700 uppercase tracking-widest mb-2 relative z-10">Total Akses Seluruh Tautan</h3>
            <span class="text-5xl font-black text-slate-900 relative z-10">{{ $totalClicks }}</span>
        </div>

        <!-- Card: Top Link -->
        <div class="bg-amber-200 border-4 border-slate-900 rounded-3xl p-6 shadow-[6px_6px_0px_0px_#0f172a] relative overflow-hidden group hover:-translate-y-1 transition-transform">
            <i data-lucide="trophy" class="w-20 h-20 text-amber-300 absolute -bottom-4 -right-4 stroke-[3] group-hover:scale-110 transition-transform"></i>
            <h3 class="text-sm font-black text-slate-700 uppercase tracking-widest mb-2 relative z-10">Tautan Terpopuler</h3>
            @if($topLink)
                <p class="text-xl font-black text-slate-900 relative z-10 truncate mb-1">{{ $topLink->title }}</p>
                <p class="text-sm font-bold text-amber-900 bg-amber-300 inline-block px-3 py-1 rounded-md border-2 border-slate-900 relative z-10">{{ $topLink->clicks }} Klik</p>
            @else
                <p class="text-xl font-black text-slate-900 relative z-10">Belum ada data</p>
            @endif
        </div>

    </div>

    <!-- 2 & 3. CHARTS AREA -->
<!-- 2 & 3. CHARTS AREA -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
        
        <!-- Bar Chart (Top 5 Links) -->
        <div class="bg-white border-4 border-slate-900 rounded-3xl p-6 shadow-[6px_6px_0px_0px_#0f172a] flex flex-col">
            <h3 class="text-lg font-black text-slate-900 border-b-4 border-slate-900 pb-3 mb-6 uppercase tracking-wider">Perbandingan Klik (Top 5)</h3>
            
            <!-- PERBAIKAN: Bungkus canvas dengan div relative dan h-72 -->
            <div class="relative w-full h-72">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <!-- Doughnut Chart (Distribusi Minat) -->
        <div class="bg-white border-4 border-slate-900 rounded-3xl p-6 shadow-[6px_6px_0px_0px_#0f172a] flex flex-col">
            <h3 class="text-lg font-black text-slate-900 border-b-4 border-slate-900 pb-3 mb-6 uppercase tracking-wider">Distribusi Minat Audiens</h3>
            
            <!-- PERBAIKAN: Bungkus canvas dengan div relative dan h-72 -->
            <div class="relative w-full h-72 flex justify-center items-center">
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>

    </div>
</div>

<!-- ========================================== -->
<!-- SCRIPT CHART.JS NEO BRUTALISM STYLE        -->
<!-- ========================================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Menyuntikkan Data PHP ke JavaScript
    const chartLabels = @json($chartLabels);
    const chartData = @json($chartData);

    // Palet Warna Neo-Brutalism (Biru, Hijau, Kuning, Merah, Ungu muda)
    const bgColors = ['#bfdbfe', '#a7f3d0', '#fde68a', '#fecdd3', '#e9d5ff'];
    const borderColors = ['#0f172a', '#0f172a', '#0f172a', '#0f172a', '#0f172a']; // Border slate-900

    // Konfigurasi Global Font
    Chart.defaults.font.family = 'Inter, sans-serif';
    Chart.defaults.font.weight = 'bold';
    Chart.defaults.color = '#0f172a';

    // 1. BAR CHART INISIALISASI
    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Jumlah Klik',
                data: chartData,
                backgroundColor: bgColors,
                borderColor: borderColors,
                borderWidth: 3,
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 },
                    grid: { color: '#e2e8f0', lineWidth: 2, borderDash: [5, 5] } // Grid putus-putus
                },
                x: {
                    grid: { display: false }
                }
            },
            plugins: {
                legend: { display: false } // Sembunyikan legenda agar lebih bersih
            }
        }
    });

    // 2. DOUGHNUT CHART INISIALISASI
    const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
    new Chart(ctxDoughnut, {
        type: 'doughnut',
        data: {
            labels: chartLabels,
            datasets: [{
                data: chartData,
                backgroundColor: bgColors,
                borderColor: borderColors,
                borderWidth: 3,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' } // Posisikan nama-nama link di kanan lingkaran
            }
        }
    });
</script>
@endsection
