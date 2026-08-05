@extends('layouts.app')

@section('title', 'Login - T-Shirt Store')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
* {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

body {
    background-color: #F8F9FA;
    color: #121212;
}

/* Container */
.login-container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px;
}

/* Card Split */
.login-card {
    width: 100%;
    max-width: 980px;
    background: #FFFFFF;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    border: 1px solid #E9ECEF;
    display: flex;
}

/* Form (Sisi Kiri) */
.form-side {
    width: 50%;
    padding: 55px 45px;
}

.login-title {
    text-align: left;
    margin-bottom: 35px;
}

.login-title h2 {
    font-family: 'Cinzel', serif;
    font-weight: 700;
    color: #121212;
    letter-spacing: 0.5px;
}

.login-title p {
    color: #6C757D;
    font-size: 0.9rem;
}

/* Input */
.form-label {
    font-weight: 600;
    color: #343A40;
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
    color: #6C757D;
}

.input-with-icon .form-control {
    padding-left: 42px;
}

.form-control {
    border-radius: 10px;
    padding: 12px 16px;
    border: 1px solid #CED4DA;
    background-color: #F8F9FA;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.form-control:focus {
    background-color: #FFFFFF;
    border-color: #121212;
    box-shadow: none;
}

/* Button */
.btn-login {
    width: 100%;
    padding: 14px;
    border: 1px solid #121212;
    border-radius: 10px;
    background-color: #121212;
    color: #FFFFFF;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-login:hover {
    background-color: #FFFFFF;
    color: #121212;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
}

/* Error */
.error-message {
    color: #212529;
    font-size: 12px;
    margin-top: 5px;
    font-weight: 500;
}

/* Branding Panel (Sisi Kanan) */
.brand-side {
    width: 50%;
    background: linear-gradient(135deg, #121212 0%, #2B2B2B 100%);
    color: #FFFFFF;
    padding: 60px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
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
}

.brand-side p {
    font-size: 15px;
    line-height: 1.8;
    color: rgba(255, 255, 255, 0.7);
}

.brand-icon {
    font-size: 60px;
    margin-bottom: 20px;
    color: #FFFFFF;
}

.login-footer {
    text-align: left;
    margin-top: 25px;
    color: #6C757D;
    font-size: 0.85rem;
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