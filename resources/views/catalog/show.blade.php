@extends('layouts.app')

@section('title', $product->name)

@section('content')
{{-- ===================== STYLE CUSTOM DETAIL PRODUK PINK-ABU ===================== --}}
<style>
    :root {
        --pink-accent: #f472b6;
        --pink-hover: #db2777;
        --grey-slate: #475569;
        --grey-light: #f1f5f9;
        --grey-muted: #94a3b8;
        --border-color: #e2e8f0;
    }

    body {
        background-color: #f8fafc;
    }

    /* Breadcrumb */
    .breadcrumb-item a {
        color: var(--grey-muted);
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: var(--pink-accent);
        font-weight: 600;
    }

    /* Image Gallery */
    .main-img-container {
        background: white;
        border-radius: 20px;
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .thumb-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border: 2px solid transparent;
        transition: 0.2s;
        border-radius: 10px;
    }

    .thumb-img:hover,
    .thumb-img.active {
        border-color: var(--pink-accent);
    }

    /* Product Info Card */
    .info-card {
        border-radius: 20px;
        background: white;
        border: 1px solid var(--border-color);
    }

    .product-title {
        color: var(--grey-slate);
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .price-large {
        color: var(--pink-accent);
        font-size: 2rem;
        font-weight: 800;
    }

    .category-badge {
        background-color: var(--grey-light);
        color: var(--grey-slate);
        border: 1px solid var(--border-color);
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Buttons */
    .btn-pink {
        background-color: var(--pink-accent);
        border-color: var(--pink-accent);
        color: white;
        font-weight: 700;
        border-radius: 12px;
        transition: 0.3s;
        padding: 12px 24px;
    }

    .btn-pink:hover {
        background-color: var(--pink-hover);
        color: white;
        transform: translateY(-2px);
    }

    .btn-wishlist-outline {
        border: 1px solid var(--border-color);
        color: var(--grey-slate);
        background: white;
        border-radius: 12px;
    }

    .btn-wishlist-outline:hover {
        border-color: #fda4af;
        color: #f43f5e;
    }

    /* Quantity Control */
    .qty-control {
        background: var(--grey-light);
        border-radius: 12px;
        border: 1px solid var(--border-color);
        padding: 5px;
    }

    .qty-btn {
        background: white;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 8px;
        color: var(--grey-slate);
        font-weight: bold;
    }

</style>

<div class="container py-5">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('catalog.index') }}">Katalog</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($product->name, 30) }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        {{-- Product Images --}}
        <div class="col-lg-6">
            <div class="main-img-container shadow-sm p-3 mb-3">
                <div class="position-relative">
                    <img src="{{ $product->image_url }}" id="main-image" class="img-fluid w-100" alt="{{ $product->name }}" style="height: 450px; object-fit: contain;">

                    @if($product->has_discount)
                    <span class="badge bg-pink position-absolute top-0 start-0 m-3 fs-6 px-3 py-2 shadow-sm" style="background-color: var(--pink-accent);">
                        Hemat {{ $product->discount_percentage }}%
                    </span>
                    @endif
                </div>
            </div>

            {{-- Thumbnail Gallery --}}
            @if($product->images->count() > 1)
            <div class="d-flex gap-2 overflow-auto pb-2">
                @foreach($product->images as $image)
                <img src="{{ asset('storage/' . $image->image_path) }}" class="thumb-img border cursor-pointer shadow-sm" onclick="document.getElementById('main-image').src = this.src">
                @endforeach
            </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div class="col-lg-6">
            <div class="card info-card border-0 shadow-sm h-100">
                <div class="card-body p-4 p-xl-5">
                    {{-- Category --}}
                    <a href="{{ route('catalog.index', ['category' => $product->category->slug]) }}" class="category-badge d-inline-block text-decoration-none mb-3">
                        <i class="bi bi-tag-fill me-1 text-pink-accent"></i> {{ $product->category->name }}
                    </a>

                    {{-- Title --}}
                    <h2 class="product-title mb-3">{{ $product->name }}</h2>

                    {{-- Price --}}
                    <div class="mb-4 p-3 rounded-4" style="background: #fff5f7;">
                        @if($product->has_discount)
                        <div class="text-muted text-decoration-line-through small fw-bold">
                            {{ $product->formatted_original_price }}
                        </div>
                        @endif
                        <div class="price-large">
                            {{ $product->formatted_price }}
                        </div>
                    </div>

                    {{-- Stock Status --}}
                    <div class="mb-4">
                        @if($product->stock > 10)
                        <span class="text-success fw-bold small bg-success bg-opacity-10 px-3 py-2 rounded-pill">
                            <i class="bi bi-check2-circle me-1"></i> Stok Ready
                        </span>
                        @elseif($product->stock > 0)
                        <span class="text-warning fw-bold small bg-warning bg-opacity-10 px-3 py-2 rounded-pill">
                            <i class="bi bi-exclamation-triangle me-1"></i> Stok Terbatas (Sisa {{ $product->stock }})
                        </span>
                        @else
                        <span class="text-danger fw-bold small bg-danger bg-opacity-10 px-3 py-2 rounded-pill">
                            <i class="bi bi-x-circle me-1"></i> Stok Habis
                        </span>
                        @endif
                    </div>

                    {{-- Add to Cart Form --}}
                    <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="row g-3">
                            <div class="col-auto">
                                <label class="form-label small fw-bold text-muted">Jumlah</label>
                                <div class="d-flex align-items-center qty-control">
                                    <button type="button" class="qty-btn shadow-sm" onclick="decrementQty()">-</button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control border-0 text-center bg-transparent fw-bold" style="width: 50px;" readonly>
                                    <button type="button" class="qty-btn shadow-sm" onclick="incrementQty()">+</button>
                                </div>
                            </div>
                            <div class="col d-flex align-items-end">
                                <button type="submit" class="btn btn-pink btn-lg w-100 shadow-sm" @if($product->stock == 0) disabled @endif>
                                    <i class="bi bi-bag-plus-fill me-2"></i> Tambah Keranjang
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="d-flex gap-2 mb-4">
                        {{-- Wishlist --}}
                        @auth
                        <button type="button" onclick="toggleWishlist({{ $product->id }})" class="btn btn-wishlist-outline px-4 py-2 flex-grow-1 shadow-sm wishlist-btn-{{ $product->id }}">
                            <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill text-danger' : 'bi-heart' }} me-2"></i>
                            Wishlist
                        </button>
                        @endauth
                    </div>

                    <hr class="opacity-10">

                    {{-- Product Details --}}
                    <div class="mb-4">
                        <h6 class="fw-bold text-slate mb-3">Deskripsi Produk</h6>
                        <div class="text-muted lh-lg small">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>

                    <div class="row text-muted small g-0 border-top pt-3">
                        <div class="col-6">
                            <i class="bi bi-box-seam me-2"></i> Berat: <strong>{{ $product->weight }} gram</strong>
                        </div>
                        <div class="col-6">
                            <i class="bi bi-hash me-2"></i> SKU: <strong>SKU-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function incrementQty() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.max);
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
        }
    }

    function decrementQty() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

</script>
@endpush
@endsection
