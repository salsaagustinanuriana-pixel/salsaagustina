{{-- =========================================================
FILE     : resources/views/home.blade.php
FUNGSI   : Halaman Beranda (Royal Purple Luxury Background)
========================================================= --}}

@extends('layouts.app')

@section('title', 'Beranda - Toko Online Terpercaya')

@section('content')

{{-- ===================== STYLE ===================== --}}
<style>
    /* ===== PALETTE WARNA ROYAL PURPLE ===== */
    :root {
        --royal-purple: #6c5ce7;
        --deep-purple: #4834d4;
        --soft-purple: #f3f0ff;
        --gold-accent: #f9ca24;
        --grad-purple: linear-gradient(135deg, #6c5ce7 0%, #4834d4 100%);
        --grad-dark: linear-gradient(135deg, #4834d4 0%, #2d3436 100%);
    }

    body {
        /* BACKGROUND SETTINGS */
        background-color: #fcfaff;
        background-image:
            radial-gradient(at 0% 0%, rgba(108, 92, 231, 0.08) 0px, transparent 50%),
            radial-gradient(at 100% 0%, rgba(249, 202, 36, 0.05) 0px, transparent 50%),
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236c5ce7' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        background-attachment: fixed;
        font-family: 'Poppins', sans-serif;
        color: #2d3436;
    }

    /* ===== HERO SECTION ===== */
    .hero {
        background: var(--grad-purple);
        border-radius: 0 0 80px 80px;
        color: #fff;
        padding: 100px 0;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(72, 52, 212, 0.2);
    }

    .hero::after {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        bottom: -200px;
        left: -100px;
    }

    .hero h1 {
        font-weight: 800;
        font-size: 3.5rem;
    }

    .hero .highlight {
        color: var(--gold-accent);
    }

    /* ===== CATEGORY CARD (GLASSMORPHISM) ===== */
    .category-card {
        border-radius: 25px;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(108, 92, 231, 0.1) !important;
        transition: all 0.4s ease;
    }

    .category-card:hover {
        background: #fff;
        border-color: var(--royal-purple) !important;
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(108, 92, 231, 0.2) !important;
    }

    .category-icon-bg {
        width: 75px;
        height: 75px;
        background: var(--soft-purple);
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        color: var(--deep-purple);
        transition: 0.3s;
    }

    .category-card:hover .category-icon-bg {
        background: var(--grad-purple);
        color: white;
        transform: rotate(-5deg);
    }

    /* ===== PREMIUM BADGE ===== */
    .premium-badge {
        background: white;
        color: var(--deep-purple);
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        display: inline-block;
        border: 1px solid rgba(108, 92, 231, 0.2);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    /* ===== PRODUCT CARD WRAPPER ===== */
    .product-card-wrapper:hover .card {
        box-shadow: 0 20px 40px rgba(108, 92, 231, 0.2) !important;
        transform: translateY(-10px);
    }

    .btn-royal {
        background: var(--grad-purple);
        color: #fff;
        border-radius: 15px;
        padding: 14px 35px;
        font-weight: 600;
        border: none;
        transition: 0.3s;
    }

    .btn-royal:hover {
        box-shadow: 0 10px 20px rgba(108, 92, 231, 0.4);
        transform: scale(1.05);
        color: white;
    }

    /* ===== PROMO BANNER ===== */
    .promo-card {
        border-radius: 35px;
        padding: 50px;
        color: #fff;
        border: none;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .promo-purple {
        background: var(--grad-dark);
    }

    .promo-gold {
        background: linear-gradient(135deg, #f9ca24 0%, #f0932b 100%);
        color: #2d3436;
    }

</style>

{{-- ===================== HERO SECTION ===================== --}}
<section class="hero mb-5">
    <div class="container">
        <div class="row align-items-center text-center text-lg-start">
            <div class="col-lg-6">
                <h1 class="mb-4">Elegansi <br><span class="highlight">Cemilan</span> Premium</h1>
                <p class="lead mb-5 opacity-75">
                    Hadirkan kebahagiaan di setiap gigitan dengan pilihan snack eksklusif yang dikurasi khusus untuk Anda.
                </p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                    <a href="{{ route('catalog.index') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold" style="border-radius: 18px; color: var(--deep-purple);">
                        Belanja Sekarang
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-center">
                <i class="bi bi-gem" style="font-size: 15rem; color: var(--gold-accent); opacity: 0.2;"></i>
            </div>
        </div>
    </div>
</section>

{{-- ===================== CATEGORY SECTION (ICON EDITION) ===================== --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="premium-badge mb-3">Pilihan Menu</span>
            <h2 class="fw-bold fs-1">Kategori <span style="color: var(--royal-purple);">Terlaris</span></h2>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($categories as $category)
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="text-decoration-none text-dark">
                    <div class="card category-card h-100 p-4 border-0 text-center">
                        <div class="category-icon-bg">
                            @php
                            $slug = strtolower($category->slug);
                            if (str_contains($slug, 'pedas')) { $icon = 'bi-fire'; }
                            elseif (str_contains($slug, 'manis') || str_contains($slug, 'cokelat')) { $icon = 'bi-ice-cream'; }
                            elseif (str_contains($slug, 'minum')) { $icon = 'bi-cup-straw'; }
                            elseif (str_contains($slug, 'kering') || str_contains($slug, 'keripik')) { $icon = 'bi-cookie'; }
                            elseif (str_contains($slug, 'gurih') || str_contains($slug, 'asin')) { $icon = 'bi-egg-fried'; }
                            else { $icon = 'bi-bag-heart'; }
                            @endphp
                            <i class="bi {{ $icon }}" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="fw-bold mb-1">{{ $category->name }}</h6>
                        <small class="text-muted">{{ $category->products_count }} Menu</small>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================== FEATURED PRODUCTS ===================== --}}
<section class="py-5">
    <div class="container">
        <div class="row align-items-end mb-5">
            <div class="col-md-7 text-center text-md-start">
                <span class="premium-badge mb-3">Signature Collection</span>
                <h2 class="fw-bold display-6">Produk Unggulan</h2>
            </div>
            <div class="col-md-5 text-center text-md-end d-none d-md-block">
                <a href="{{ route('catalog.index') }}" class="btn-royal text-decoration-none">Lihat Semua</a>
            </div>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $product)
            <div class="col-6 col-md-4 col-lg-3 product-card-wrapper">
                @include('partials.product-card', compact('product'))
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================== PROMO BANNER ===================== --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="promo-card promo-purple shadow-lg h-100">
                    <h2 class="fw-bold">Eksklusif Member</h2>
                    <p class="opacity-75">Dapatkan potongan harga khusus dan poin di setiap pembelian.</p>
                    <a href="{{ route('register') }}" class="btn btn-light mt-4 fw-bold px-4 py-2" style="border-radius: 12px; color: var(--deep-purple);">Gabung Sekarang</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="promo-card promo-gold shadow-lg h-100">
                    <h2 class="fw-bold">Flash Sale ⚡</h2>
                    <p class="opacity-75">Diskon hingga 40% untuk kategori snack favorit pilihan minggu ini.</p>
                    <button class="btn btn-dark mt-4 fw-bold px-4 py-2 text-white" style="border-radius: 12px; border:none;">Klaim Promo</button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================== LATEST PRODUCTS ===================== --}}
<section class="py-5 mb-5 mx-2 mx-md-4" style="background: rgba(255,255,255,0.5); border-radius: 50px; border: 1px solid rgba(108,92,231,0.1);">
    <div class="container">
        <div class="text-center mb-5">
            <span class="premium-badge mb-3">Terbaru</span>
            <h2 class="fw-bold">Update Snack Minggu Ini</h2>
        </div>
        <div class="row g-4">
            @foreach($latestProducts as $product)
            <div class="col-6 col-md-4 col-lg-3 product-card-wrapper">
                @include('partials.product-card', compact('product'))
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
