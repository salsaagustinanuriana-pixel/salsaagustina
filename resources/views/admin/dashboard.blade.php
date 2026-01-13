@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
    :root {
        --pink-main: #ec4899;
        --pink-soft: #f9a8d4;
        --gray-bg: #f3f4f6;
        --gray-text: #6b7280;
    }

    .border-pink { border-color: var(--pink-main) !important; }
    .text-pink { color: var(--pink-main) !important; }
    .bg-pink-soft { background-color: rgba(236, 72, 153, 0.12); }

    .border-gray { border-color: #9ca3af !important; }
    .text-gray { color: var(--gray-text) !important; }
    .bg-gray-soft { background-color: #e5e7eb; }

    .hover-shadow:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.08);
    }
</style>

{{-- ===================== STATS ===================== --}}
<div class="row g-4 mb-4">

    {{-- Revenue --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm border-start border-4 border-pink h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase fw-semibold mb-1 text-gray" style="font-size:.8rem">Total Pendapatan</p>
                    <h4 class="fw-bold text-pink mb-0">
                        Rp {{ number_format($stats['total_revenue'],0,',','.') }}
                    </h4>
                </div>
                <div class="bg-pink-soft p-3 rounded">
                    <i class="bi bi-wallet2 text-pink fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Pending --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm border-start border-4 border-gray h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase fw-semibold mb-1 text-gray" style="font-size:.8rem">Perlu Diproses</p>
                    <h4 class="fw-bold text-dark mb-0">{{ $stats['pending_orders'] }}</h4>
                </div>
                <div class="bg-gray-soft p-3 rounded">
                    <i class="bi bi-box-seam text-dark fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Low Stock --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm border-start border-4 border-pink h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase fw-semibold mb-1 text-gray" style="font-size:.8rem">Stok Menipis</p>
                    <h4 class="fw-bold text-pink mb-0">{{ $stats['low_stock'] }}</h4>
                </div>
                <div class="bg-pink-soft p-3 rounded">
                    <i class="bi bi-exclamation-triangle text-pink fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Products --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm border-start border-4 border-gray h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase fw-semibold mb-1 text-gray" style="font-size:.8rem">Total Produk</p>
                    <h4 class="fw-bold text-dark mb-0">{{ $stats['total_products'] }}</h4>
                </div>
                <div class="bg-gray-soft p-3 rounded">
                    <i class="bi bi-tags fs-3 text-dark"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===================== CHART + ORDERS ===================== --}}
<div class="row g-4">

    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-pink">Grafik Penjualan (7 Hari)</h5>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-pink">Pesanan Terbaru</h5>
            </div>

            <div class="list-group list-group-flush">
                @foreach($recentOrders as $order)
                    <div class="list-group-item d-flex justify-content-between">
                        <div>
                            <strong class="text-pink">#{{ $order->order_number }}</strong><br>
                            <small class="text-gray">{{ $order->user->name }}</small>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold">
                                Rp {{ number_format($order->total_amount,0,',','.') }}
                            </div>
                            <span class="badge bg-pink-soft text-pink">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card-footer text-center bg-white">
                <a href="{{ route('admin.orders.index') }}" class="fw-bold text-pink text-decoration-none">
                    Lihat Semua →
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ===================== TOP PRODUCTS ===================== --}}
<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0 text-pink">Produk Terlaris</h5>
    </div>
    <div class="card-body">
        <div class="row g-4">
            @foreach($topProducts as $product)
                <div class="col-6 col-md-2 text-center">
                    <div class="card border-0 hover-shadow">
                        <img src="{{ $product->image_url }}" class="rounded mb-2" style="height:90px;object-fit:cover">
                        <h6 class="text-truncate">{{ $product->name }}</h6>
                        <small class="text-gray">{{ $product->sold }} terjual</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ===================== CHART JS ===================== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($revenueChart->pluck('date')) !!},
        datasets: [{
            data: {!! json_encode($revenueChart->pluck('total')) !!},
            borderColor: '#ec4899',
            backgroundColor: 'rgba(236,72,153,.15)',
            tension: .3,
            fill: true,
            pointRadius: 4
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true },
            x: { grid: { display: false } }
        }
    }
});
</script>

@endsection
