{{-- ========================================
FILE: resources/views/auth/login.blade.php
FUNGSI: Halaman form login (Elegant Pink – Grey)
======================================== --}}

@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #f5f5f7;
        /* abu soft modern */
    }

    .card {
        border-radius: 18px;
        border: none;
        background-color: #ffffff;
    }

    .card-header {
        background: linear-gradient(135deg, #f3c1d9, #e6a6c6);
        /* dusty pink */
        border-radius: 18px 18px 0 0;
    }

    .btn-primary {
        background-color: #e6a6c6;
        border: none;
    }

    .btn-primary:hover {
        background-color: #d98ab3;
    }

    .form-control {
        border-radius: 10px;
    }

    .form-control:focus {
        border-color: #e6a6c6;
        box-shadow: 0 0 0 0.2rem rgba(230, 166, 198, 0.25);
    }

    .form-check-input:checked {
        background-color: #e6a6c6;
        border-color: #e6a6c6;
    }

    a {
        color: #c76a9a;
    }

    a:hover {
        color: #ad4f80;
    }

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-header text-white text-center">
                    <h4 class="mb-0">🔐 Login ke Akun Anda</h4>
                </div>

                <div class="card-body p-4">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nama@email.com">
                            @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                            @error('password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Ingat Saya
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Login
                            </button>
                        </div>

                        <div class="mt-3 text-center">
                            @if (Route::has('password.request'))
                            <a class="text-decoration-none" href="{{ route('password.request') }}">
                                Lupa Password?
                            </a>
                            @endif
                        </div>

                        <hr>

                        <div class="d-grid gap-2">
                            <a href="{{ route('auth.google') }}" class="btn btn-outline-secondary btn-lg">
                                <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="20" class="me-2">
                                Login dengan Google
                            </a>
                        </div>

                        <p class="mt-4 text-center mb-0">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="fw-bold text-decoration-none">
                                Daftar Sekarang
                            </a>
                        </p>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

