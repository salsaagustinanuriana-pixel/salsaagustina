@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')

<style>
    /* ===== GREY & PINK MODERN THEME ===== */
    :root {
        --bg-slate: #e5e7eb;
        /* Abu-abu background luar */
        --panel-white: #ffffff;
        /* Putih panel */
        --accent-pink: #f472b6;
        /* Pink cerah untuk aksen */
        --dark-pink: #db2777;
        /* Pink tua untuk hover */
        --slate-dark: #1f2937;
        /* Abu-abu gelap untuk teks utama */
        --slate-text: #6b7280;
        /* Abu-abu medium untuk teks sekunder */
        --border-slate: #d1d5db;
        /* Warna border */
    }

    /* Container Styling */
    .main-container {
        background: var(--bg-slate);
        min-height: 100vh;
        padding: 2rem 1.5rem;
    }

    .custom-card {
        background: var(--panel-white);
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    /* Header & Action Button */
    .header-pink-line {
        height: 4px;
        background: linear-gradient(90deg, var(--accent-pink), #ec4899);
    }

    .btn-pink-action {
        background: var(--accent-pink);
        color: white;
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-pink-action:hover {
        background: var(--dark-pink);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(244, 114, 182, 0.4);
    }

    /* Filter Box */
    .filter-area {
        background: #f9fafb;
        padding: 1.5rem;
        border-bottom: 1px solid var(--border-slate);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--accent-pink);
        box-shadow: 0 0 0 3px rgba(244, 114, 182, 0.1);
    }

    /* Table Customization */
    .table thead th {
        background: #f3f4f6;
        color: var(--slate-dark);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        padding: 1rem;
        border-bottom: 2px solid var(--border-slate);
    }

    .table tbody td {
        padding: 1.2rem 1rem;
        border-bottom: 1px solid #f3f4f6;
        color: var(--slate-dark);
    }

    /* Product UI Elements */
    .img-frame {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        object-fit: cover;
        border: 2px solid var(--bg-slate);
    }

    .sku-tag {
        font-family: 'Monaco', 'Consolas', monospace;
        color: var(--accent-pink);
        font-size: 0.7rem;
        font-weight: 700;
        background: rgba(244, 114, 182, 0.1);
        padding: 2px 6px;
        border-radius: 4px;
    }

    /* Status Badges */
    .status-pill {
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .pill-active {
        background: #dcfce7;
        color: #15803d;
    }

    .pill-stock {
        background: #f3f4f6;
        color: var(--slate-dark);
        border: 1px solid var(--border-slate);
    }

    /* Action Icons */
    .btn-icon-grey {
        color: var(--slate-text);
        padding: 6px;
        border-radius: 8px;
        transition: 0.2s;
        text-decoration: none;
    }

    .btn-icon-grey:hover {
        background: var(--bg-slate);
        color: var(--slate-dark);
    }

    .btn-icon-pink:hover {
        background: rgba(244, 114, 182, 0.1);
        color: var(--accent-pink);
    }

</style>

<div class="main-container">
    {{-- TITLE SECTION --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--slate-dark);">Katalog Produk</h2>
            <p class="text-muted small mb-0">Atur inventori dan tampilan produk toko Anda</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-pink-action shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Tambah Baru
        </a>
    </div>

    <div class="custom-card">
        <div class="header-pink-line"></div>

        {{-- FILTER AREA --}}
        <div class="filter-area">
            <form method="GET" class="row g-3">
                <div class="col-md-5">
                    <label class="small fw-bold text-muted mb-2">Pencarian Cepat</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Nama produk atau SKU..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="small fw-bold text-muted mb-2">Kategori</label>
                    <select name="category" class="form-select text-muted">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-dark w-100 fw-bold" style="padding: 0.7rem; border-radius: 10px; background: var(--slate-dark);">
                        <i class="bi bi-funnel me-2"></i> Saring Data
                    </button>
                </div>
            </form>
        </div>

        {{-- TABLE DATA --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Detail Produk</th>
                        <th>Kategori</th>
                        <th class="text-center">Harga Jual</th>
                        <th class="text-center">Sisa Stok</th>
                        <th class="text-center">Status</th>
                        <th class="text-end pe-4">Kelola</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ $product->primaryImage?->image_url ?? 'https://placehold.co/100/e5e7eb/6b7280?text=IMG' }}" class="img-frame me-3 shadow-sm">
                                <div>
                                    <div class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">{{ $product->name }}</div>
                                    <span class="sku-tag">SKU-{{ strtoupper($product->sku ?? 'unknwn') }}</span>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="text-muted small fw-semibold">{{ $product->category->name }}</span>
                        </td>

                        <td class="text-center">
                            <span class="fw-bold" style="color: var(--slate-dark);">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </td>

                        <td class="text-center">
                            <span class="status-pill pill-stock">
                                <i class="bi bi-box-seam me-1"></i> {{ $product->stock }}
                            </span>
                        </td>

                        <td class="text-center">
                            @if($product->is_active)
                            <span class="status-pill pill-active"><i class="bi bi-check-circle-fill me-1"></i> Aktif</span>
                            @else
                            <span class="status-pill text-muted bg-light border">Nonaktif</span>
                            @endif
                        </td>

                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('admin.products.show', $product) }}" class="btn-icon-grey btn-icon-pink" title="Lihat">
                                    <i class="bi bi-eye-fill fs-5"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn-icon-grey btn-icon-pink" title="Edit">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data produk?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon-grey border-0 bg-transparent" style="color: #ef4444;" title="Hapus">
                                        <i class="bi bi-trash3-fill fs-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80" class="opacity-25 mb-3">
                            <p class="text-muted fw-bold">Belum ada produk yang ditambahkan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($products->hasPages())
        <div class="card-footer bg-white border-0 py-4 px-4">
            <div class="d-flex justify-content-end">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
