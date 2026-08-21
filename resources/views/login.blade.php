@extends('layouts.app')

@section('title', 'Login - T-Shirt Store')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
:root {
    --color-blue: #2563EB;
    --color-black: #0F172A;
    --color-gray: #94A3B8;
}

* {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

body {
    /* Gradien dari pojok kiri atas (Biru) ke pojok kanan bawah (Hitam) */
    background: linear-gradient(135deg, #1E3A8A 0%, var(--color-black) 100%);
    color: #FFFFFF;
    min-height: 100vh;
}

/* Container */
.login-container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px;
    position: relative;
    overflow: hidden;
}

/* Ornamen Efek Cahaya Kaca Kiri Atas & Kanan Bawah */
.login-container::before {
    content: '';
    position: absolute;
    top: -100px;
    left: -100px;
    width: 350px;
    height: 350px;
    background: rgba(37, 99, 235, 0.4);
    filter: blur(100px);
    border-radius: 50%;
    pointer-events: none;
}

.login-container::after {
    content: '';
    position: absolute;
    bottom: -100px;
    right: -100px;
    width: 350px;
    height: 350px;
    background: rgba(15, 23, 42, 0.8);
    filter: blur(100px);
    border-radius: 50%;
    pointer-events: none;
}

/* Card Split Glassmorphism */
.login-card {
    width: 100%;
    max-width: 980px;
    /* Glassmorphism/Kaca */
    background: rgba(255, 255, 255, 0.07);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.15);
    display: flex;
    position: relative;
    z-index: 1;
}

/* Form (Sisi Kiri) */
.form-side {
    width: 50%;
    padding: 55px 45px;
    background: rgba(15, 23, 42, 0.3);
}

.login-title {
    text-align: left;
    margin-bottom: 35px;
}

.login-title h2 {
    font-family: 'Cinzel', serif;
    font-weight: 700;
    color: #FFFFFF;
    letter-spacing: 0.5px;
}

.login-title p {
    color: var(--color-gray);
    font-size: 0.9rem;
}

/* Input */
.form-label {
    font-weight: 600;
    color: var(--color-gray);
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.input-with-icon {
    position: relative;
}

.input-with-icon i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--color-gray);
    transition: color 0.3s ease;
}

.input-with-icon .form-control {
    padding-left: 42px;
}

.form-control {
    border-radius: 12px;
    padding: 12px 16px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    background-color: rgba(255, 255, 255, 0.05);
    color: #FFFFFF;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.form-control::placeholder {
    color: rgba(148, 163, 184, 0.6);
}

.form-control:focus {
    background-color: rgba(255, 255, 255, 0.1);
    border-color: var(--color-blue);
    color: #FFFFFF;
    box-shadow: 0 0 15px rgba(37, 99, 235, 0.3);
}

.form-control:focus + i,
.input-with-icon:focus-within i {
    color: var(--color-blue);
}

/* Button */
.btn-login {
    width: 100%;
    padding: 14px;
    border: 1px solid var(--color-blue);
    border-radius: 12px;
    background-color: var(--color-blue);
    color: #FFFFFF;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
}

.btn-login:hover {
    background-color: transparent;
    color: #FFFFFF;
    border-color: var(--color-blue);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.5);
    transform: translateY(-2px);
}

/* Error */
.error-message {
    color: #EF4444;
    font-size: 12px;
    margin-top: 6px;
    font-weight: 500;
}

/* Branding Panel (Sisi Kanan) */
.brand-side {
    width: 50%;
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.25) 0%, rgba(15, 23, 42, 0.6) 100%);
    color: #FFFFFF;
    padding: 60px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    border-left: 1px solid rgba(255, 255, 255, 0.1);
}

.brand-side::before {
    content: "\F598";
    font-family: "bootstrap-icons";
    position: absolute;
    font-size: 180px;
    opacity: 0.05;
    top: 20px;
    right: 20px;
    color: #FFFFFF;
}

.brand-side h1 {
    font-family: 'Cinzel', serif;
    font-weight: 700;
    font-size: 38px;
    letter-spacing: 1px;
    margin-bottom: 15px;
    color: #FFFFFF;
}

.brand-side p {
    font-size: 15px;
    line-height: 1.8;
    color: var(--color-gray);
}

.brand-icon {
    font-size: 60px;
    margin-bottom: 20px;
    color: var(--color-blue);
}

.login-footer {
    text-align: left;
    margin-top: 25px;
    color: var(--color-gray);
    font-size: 0.85rem;
    opacity: 0.7;
}

/* Responsive */
@media(max-width: 768px) {
    .login-card {
        flex-direction: column;
    }

    .form-side,
    .brand-side {
        width: 100%;
    }

    .brand-side {
        padding: 40px;
        text-align: center;
        border-left: none;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .brand-side h1 {
        font-size: 28px;
    }
}
</style>

<div class="login-container">

<div class="login-card">

    <!-- Sisi Kiri: Form Login -->
    <div class="form-side">

        <div class="login-title">
            <h2>Masuk ke Akun</h2>
            <p>Silakan login untuk mengakses sistem</p>
        </div>

        <form action="{{ route('auth') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-with-icon">
                    <i class="bi bi-envelope"></i>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Masukkan alamat email">
                </div>

                @error('email')
                <div class="error-message">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-with-icon">
                    <i class="bi bi-lock"></i>
                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password">
                </div>

                @error('password')
                <div class="error-message">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                Masuk Sekarang
            </button>

        </form>

        <div class="login-footer">
            © {{ date('Y') }} T-Shirt Store. All rights reserved.
        </div>

    </div>

    <!-- Sisi Kanan: Panel Branding -->
    <div class="brand-side">

        <div class="brand-icon">
            <i class="bi bi-tag"></i>
        </div>

        <h1>T-Shirt Store</h1>
        <p>Eksplorasi koleksi t-shirt premium dengan kualitas kain terbaik dan desain elegan.</p>

    </div>

</div>

</div>

@endsection