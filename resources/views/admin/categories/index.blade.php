{{-- =========================================================
FILE     : resources/views/admin/categories/index.blade.php
TEMA     : Royal Purple Admin (Icon Edition)
========================================================= --}}

@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@push('styles')
<style>
    /* ===== PALETTE & VARIABLE ===== */
    :root {
        --primary-purple: #6c5ce7;
        --dark-purple: #4834d4;
        --soft-purple: #f3f0ff;
        --text-dark: #2d3436;
        --grad-purple: linear-gradient(135deg, #6c5ce7, #4834d4);
    }

    .bi {
        font-family: bootstrap-icons !important;
    }

    /* ===== CARD & TABLE STYLING ===== */
    .card-custom {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(108, 92, 231, 0.1) !important;
        overflow: hidden;
    }

    .card-header-purple {
        background: white;
        padding: 1.5rem;
        border-bottom: 1px solid #f1f2f6;
    }

    .table thead th {
        background: #fcfaff;
        color: var(--primary-purple);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        border: none;
        padding: 1.2rem 1rem;
    }

    .table tbody td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f8f9fa;
    }

    .table-hover tbody tr:hover {
        background-color: var(--soft-purple) !important;
        transition: 0.3s;
    }

    /* ===== ICON CATEGORY BOX ===== */
    .icon-category-box {
        width: 48px;
        height: 48px;
        background: var(--grad-purple);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 1.4rem;
        box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3);
    }

    /* ===== BUTTONS & BADGES ===== */
    .btn-purple {
        background: var(--grad-purple);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 10px 24px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-purple:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(108, 92, 231, 0.4);
        color: white;
    }

    .btn-outline-purple {
        border: 2px solid var(--primary-purple);
        color: var(--primary-purple);
        border-radius: 10px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-outline-purple:hover {
        background: var(--primary-purple);
        color: white;
    }

    .badge-status {
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    /* ===== MODAL ===== */
    .modal-content {
        border-radius: 25px;
        border: none;
    }

    .modal-header {
        background: var(--grad-purple);
        color: white;
        border-radius: 25px 25px 0 0;
        padding: 1.5rem;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px;
        border: 1.5px solid #eee;
    }

    .form-control:focus {
        border-color: var(--primary-purple);
        box-shadow: 0 0 0 0.25rem rgba(108, 92, 231, 0.1);
    }

</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">

            {{-- ALERT --}}
            @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2 fs-4"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="card card-custom">
                {{-- HEADER --}}
                <div class="card-header-purple d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-grid-fill me-2 text-primary"></i> Master Kategori
                        </h4>
                        <small class="text-muted">Kelola kategori makanan dan snack</small>
                    </div>
                    <button class="btn btn-purple" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bi bi-plus-lg me-2"></i> Tambah Kategori
                    </button>
                </div>

                {{-- TABLE --}}
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Info Kategori</th>
                                    <th class="text-center">Total Produk</th>
                                    <th class="text-center">Status Aktif</th>
                                    <th class="text-end pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            {{-- ICON LOGIC BASED ON SLUG --}}
                                            <div class="icon-category-box me-3">
                                                @php
                                                $icons = [
                                                'snack-kering' => 'bi-cookie',
                                                'pedas' => 'bi-fire',
                                                'minuman' => 'bi-cup-straw',
                                                'manis' => 'bi-ice-cream',
                                                'gurih' => 'bi-egg-fried',
                                                ];
                                                $icon = $icons[$category->slug] ?? 'bi-box2-heart';
                                                @endphp
                                                <i class="bi {{ $icon }}"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0 text-dark">{{ $category->name }}</h6>
                                                <small class="text-muted">Slug: {{ $category->slug }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                            <i class="bi bi-layers me-1 text-primary"></i> {{ $category->products_count }} Produk
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($category->is_active)
                                        <span class="badge bg-success-subtle text-success badge-status">
                                            <i class="bi bi-check-circle-fill me-1"></i> Aktif
                                        </span>
                                        @else
                                        <span class="badge bg-secondary-subtle text-secondary badge-status">
                                            <i class="bi bi-slash-circle me-1"></i> Non-Aktif
                                        </span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button class="btn btn-sm btn-outline-purple" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 10px;">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="opacity-25 mb-3">
                                            <i class="bi bi-folder2-open display-1"></i>
                                        </div>
                                        <h5 class="text-muted">Data Kategori Masih Kosong</h5>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-white border-0 py-4">
                    <div class="d-flex justify-content-center">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL CREATE --}}
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle-fill me-2"></i>Tambah Kategori Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-4">
                    <label class="form-label fw-bold">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Snack Kering" required>
                </div>
                <div class="form-check form-switch p-3 bg-light rounded-4">
                    <input class="form-check-input ms-0 me-2" type="checkbox" name="is_active" value="1" checked>
                    <label class="form-check-label fw-bold">Aktifkan Kategori</label>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-purple px-4">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
@foreach($categories as $category)
<div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="bi bi-pencil-fill me-2"></i>Ubah Kategori</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-4">
                    <label class="form-label fw-bold">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>
                <div class="form-check form-switch p-3 bg-light rounded-4">
                    <input class="form-check-input ms-0 me-2" type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold">Status Aktif</label>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-purple px-4">Update Kategori</button>
            </div>
        </form>
    </div>
</div>
@endforeach

@endsection
