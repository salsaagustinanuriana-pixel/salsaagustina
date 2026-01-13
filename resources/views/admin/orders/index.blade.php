@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-grey-dark fw-bold">Daftar Pesanan</h2>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-header bg-white py-3 border-bottom-0">
        {{-- Filter Status --}}
        <ul class="nav nav-pills card-header-pills custom-pills">
            <li class="nav-item">
                <a class="nav-link {{ !request('status') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'pending']) }}">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'processing' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'processing']) }}">Diproses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'completed' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'completed']) }}">Selesai</a>
            </li>
        </ul>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-grey-light">
                    <tr>
                        <th class="ps-4 border-0 text-grey-muted small fw-bold">NO. ORDER</th>
                        <th class="border-0 text-grey-muted small fw-bold">CUSTOMER</th>
                        <th class="border-0 text-grey-muted small fw-bold">TANGGAL</th>
                        <th class="border-0 text-grey-muted small fw-bold">TOTAL</th>
                        <th class="border-0 text-grey-muted small fw-bold">STATUS</th>
                        <th class="text-end pe-4 border-0 text-grey-muted small fw-bold">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4 fw-bold text-pink">#{{ $order->order_number }}</td>
                        <td>
                            <div class="fw-bold text-grey-dark">{{ $order->user->name }}</div>
                            <small class="text-muted">{{ $order->user->email }}</small>
                        </td>
                        <td class="text-grey-dark">{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td class="fw-bold text-grey-dark">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>
                            @if($order->status == 'pending')
                            <span class="badge badge-soft-warning">Pending</span>
                            @elseif($order->status == 'processing')
                            <span class="badge badge-soft-info">Diproses</span>
                            @elseif($order->status == 'completed')
                            <span class="badge badge-soft-success">Selesai</span>
                            @elseif($order->status == 'cancelled')
                            <span class="badge badge-soft-danger">Batal</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-pink-outline">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Tidak ada pesanan ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-top-0 py-3">
        <div class="custom-pagination">
            {{ $orders->links() }}
        </div>
    </div>
</div>

<style>
    :root {
        --primary-pink: #ff85a2;
        --soft-pink: #fff0f3;
        --grey-dark: #4a4a4a;
        --grey-muted: #8e8e8e;
        --grey-light: #f8f9fa;
        --border-color: #eee;
    }

    body {
        background-color: #f5f6f8;
    }

    .text-pink {
        color: var(--primary-pink) !important;
    }

    .text-grey-dark {
        color: var(--grey-dark) !important;
    }

    .text-grey-muted {
        color: var(--grey-muted) !important;
    }

    .bg-grey-light {
        background-color: var(--grey-light) !important;
    }

    /* Card Styling */
    .rounded-4 {
        border-radius: 1rem !important;
    }

    .card {
        border: 1px solid var(--border-color);
    }

    /* Custom Navigation Pills */
    .custom-pills .nav-link {
        color: var(--grey-muted);
        font-weight: 600;
        padding: 0.5rem 1.2rem;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .custom-pills .nav-link.active {
        background-color: var(--primary-pink) !important;
        color: white !important;
        box-shadow: 0 4px 10px rgba(255, 133, 162, 0.3);
    }

    .custom-pills .nav-link:hover:not(.active) {
        background-color: var(--soft-pink);
        color: var(--primary-pink);
    }

    /* Badge Soft Styling */
    .badge {
        padding: 0.5em 0.8em;
        border-radius: 6px;
        font-weight: 600;
    }

    .badge-soft-warning {
        background-color: #fff8e1;
        color: #ffa000;
    }

    .badge-soft-info {
        background-color: #e3f2fd;
        color: #1976d2;
    }

    .badge-soft-success {
        background-color: #e8f5e9;
        color: #2e7d32;
    }

    .badge-soft-danger {
        background-color: #ffebee;
        color: #c62828;
    }

    /* Button Styling */
    .btn-pink-outline {
        color: var(--primary-pink);
        border: 1.5px solid var(--primary-pink);
        font-weight: 600;
        border-radius: 8px;
        padding: 0.4rem 1rem;
        transition: all 0.3s;
    }

    .btn-pink-outline:hover {
        background-color: var(--primary-pink);
        color: white;
        box-shadow: 0 4px 8px rgba(255, 133, 162, 0.2);
    }

    /* Table Styling */
    .table thead th {
        letter-spacing: 0.5px;
    }

    .table-hover tbody tr:hover {
        background-color: #fff9fa;
    }

    /* Pagination Custom Color */
    .custom-pagination .page-item.active .page-link {
        background-color: var(--primary-pink);
        border-color: var(--primary-pink);
    }

    .custom-pagination .page-link {
        color: var(--primary-pink);
    }

</style>
@endsection
