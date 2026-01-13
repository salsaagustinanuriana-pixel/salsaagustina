{{-- =========================================================
FILE     : resources/views/home.blade.php
FUNGSI   : Halaman Beranda (Pink Dreamy Aesthetic Edition)
========================================================= --}}

@extends('layouts.app')

@section('title', 'Beranda - Toko Snack Premium')

@section('content')

{{-- ===================== STYLE PINK AESTHETIC ===================== --}}
<style>
    :root {
        /* Background Utama: Pink sangat muda/pastel (Lavender Blush) */
        --bg-soft: #fff5f7;

        /* Abu-abu slate untuk teks sekunder agar tetap elegan */
        --grey-slate: #707070;

        /* Abu-abu arang tua untuk teks utama */
        --charcoal: #2d3436;

        /* Pink cerah untuk aksen tombol & judul */
        --pink-accent: #f472b6;

        /* Pink medium untuk dekorasi */
        --pink-soft: #ffe4e9;

        /* Putih murni untuk kartu agar "pop out" di atas bg pink */
        --white: #ffffff;
    }

    body {
        background-color: var(--bg-soft);
        font-family: 'Inter', sans-serif;
        color: var(--charcoal);
    }

    /* ===== HERO SECTION ===== */
    .hero-section {
        background: linear-gradient(135deg, var(--white) 0%, var(--bg-soft) 100%);
        border-bottom: 2px solid var(--pink-soft);
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }

    /* Dekorasi Lingkaran Pink di Background */
    .hero-section::after {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 400px;
        height: 400px;
        background: var(--pink-soft);
        border-radius: 50%;
        opacity: 0.6;
        z-index: 0;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-weight: 800;
        font-size: 3.8rem;
        color: var(--charcoal);
        letter-spacing: -1.5px;
        line-height: 1.1;
    }

    .hero-title span {
        color: var(--pink-accent);
    }

    .hero-subtitle {
        color: var(--grey-slate);
        font-size: 1.15rem;
        max-width: 550px;
    }

    /* Gambar Statis dengan Animasi Lembut */
    .hero-image-static {
        max-height: 450px;
        filter: drop-shadow(0 25px 50px rgba(244, 114, 182, 0.3));
        transition: transform 0.5s ease;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    /* ===== CATEGORY CARDS ===== */
    .category-card {
        background: var(--white);
        border: 1px solid var(--pink-soft);
        border-radius: 24px;
        padding: 30px 20px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .category-card:hover {
        border-color: var(--pink-accent);
        background: var(--pink-soft);
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(244, 114, 182, 0.1);
    }

    .icon-box {
        width: 70px;
        height: 70px;
        background: var(--bg-soft);
        border-radius: 20px;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--pink-soft);
        transition: 0.3s;
    }

    .category-card:hover .icon-box {
        background: var(--white);
        border-color: var(--pink-accent);
        transform: rotate(10deg);
    }

    /* ===== BUTTONS ===== */
    .btn-pink-custom {
        background: var(--pink-accent);
        color: var(--white);
        padding: 14px 40px;
        border-radius: 12px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(244, 114, 182, 0.3);
    }

    .btn-pink-custom:hover {
        background: #db2777;
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(244, 114, 182, 0.4);
        color: white;
    }

    /* ===== PRODUCT SECTION ===== */
    .section-label {
        color: var(--pink-accent);
        text-transform: uppercase;
        font-size: 0.85rem;
        font-weight: 800;
        letter-spacing: 2px;
        background: var(--pink-soft);
        padding: 4px 12px;
        border-radius: 6px;
        display: inline-block;
        margin-bottom: 12px;
    }

    .product-card-wrapper {
        background: var(--white);
        border-radius: 24px;
        padding: 12px;
        border: 1px solid var(--pink-soft);
        transition: 0.3s;
    }

    .product-card-wrapper:hover {
        border-color: var(--pink-accent);
        box-shadow: 0 20px 40px rgba(244, 114, 182, 0.15);
    }

    .premium-badge {
        background: var(--charcoal);
        color: var(--white);
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .view-all-link {
        color: var(--pink-accent);
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        transition: 0.2s;
        border-bottom: 2px solid transparent;
    }

    .view-all-link:hover {
        border-color: var(--pink-accent);
    }

</style>

{{-- ===================== HERO SECTION ===================== --}}
<section class="hero-section mb-5">
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center text-lg-start">
                <span class="section-label">Snack Online Sekolah</span>
                <h1 class="hero-title mb-4">Jajan Seru <span>Tanpa Antre</span> di Kantin!</h1>
                <p class="hero-subtitle mb-5">
                    Pilihan snack favorit anak sekolah dengan harga ramah kantong. Praktis, cepat, dan bisa dinikmati kapan saja bersama teman-temanmu.
                </p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                    <a href="{{ route('catalog.index') }}" class="btn btn-pink-custom text-decoration-none">
                        pesan sekarang <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            {{-- BAGIAN GAMBAR: Diganti dari Carousel menjadi Gambar Tunggal --}}
            <div class="col-lg-6 d-none d-lg-block text-center">
                <img src="{{ asset('images/jajanan.png') }}" class="hero-image-static img-fluid" alt="Snack Sekolah">
            </div>
        </div>
    </div>
</section>

{{-- ===================== CATEGORY SECTION ===================== --}}
<section id="kategori" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">Kategori Jajanan</h2>
            <p class="text-muted">Temukan snack sesuai selera kamu</p>
            <div style="width: 50px; height: 3px; background: var(--pink-accent); margin: 0 auto;"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($categories as $category)
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="text-decoration-none text-dark">
                    <div class="category-card h-100 text-center">
                        <div class="icon-box">
                            <img src="{{ $category->image_url }}" class="w-75 h-75" style="object-fit:contain">
                        </div>
                        <h6 class="fw-bold mb-1" style="font-size: 0.95rem;">{{ $category->name }}</h6>
                        <small class="text-muted fw-semibold" style="font-size: 0.75rem; color: var(--pink-accent) !important;">
                            {{ $category->products_count }} Pilihan
                        </small>
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
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <span class="section-label">Favorit Pelajar</span>
                <h2 class="fw-bold mb-0">Produk Unggulan
                    
                </h2>
            </div>
            <a href="{{ route('catalog.index') }}" class="view-all-link">LIHAT SEMUA SNACK →</a>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card-wrapper">
                    @include('partials.product-card', compact('product'))
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>



{{-- ===================== LATEST UPDATE ===================== --}}
<section class="py-5 mb-5 mx-2 mx-md-4" style="background: var(--charcoal); border-radius: 40px; color: white;">
    <div class="container py-4">
        <div class="row align-items-center mb-5 px-3">
            <div class="col-md-6">
                <span class="premium-badge mb-3" style="background: var(--pink-accent);">New Arrivals</span>
                <h2 class="fw-bold display-6">Produk Terbaru</h2>
                <p class="text-light opacity-75">Baru saja restok! Jangan sampai kehabisan lagi.</p>
            </div>
        </div>

        <div class="row g-4 px-3">
            @foreach($latestProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card-wrapper bg-white">
                    @include('partials.product-card', compact('product'))
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
