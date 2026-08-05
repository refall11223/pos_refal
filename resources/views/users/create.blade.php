@extends('layouts.app')

@section('title', 'Tambah T-Shirt User')

@section('content')

@include('layouts.navbar')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Cinzel:wght@600;700&display=swap');

:root {
    --bg-main: #F8F9FA;
    --card-bg: #FFFFFF;
    --primary-black: #121212;
    --soft-black: #2B2B2B;
    --text-muted: #6C757D;
    --border-color: #E9ECEF;
    --hover-bg: #F1F3F5;
}

body {
    background: var(--bg-main);
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--primary-black);
}

.serif-font {
    font-family: 'Cinzel', serif;
    letter-spacing: 0.5px;
}

/* ================= HEADER ================= */

.page-header {
    background: linear-gradient(135deg, #121212 0%, #2B2B2B 100%);
    border-radius: 20px;
    padding: 30px 35px;
    margin-bottom: 35px;
    color: #FFFFFF;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.page-header h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.page-header p {
    color: rgba(255, 255, 255, 0.7);
    margin: 0;
    font-size: 15px;
}

.header-icon {
    width: 65px;
    height: 65px;
    border-radius: 16px;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
    margin-right: 20px;
    border: 1px solid rgba(255, 255, 255, 0.15);
}

/* ================= CARD ================= */

.form-card {
    background: var(--card-bg);
    border-radius: 20px;
    padding: 40px;
    max-width: 900px;
    margin: auto;
    border: 1px solid var(--border-color);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.03);
}

/* ================= FORM ================= */

.form-label {
    color: var(--primary-black);
    font-weight: 600;
    margin-bottom: 8px;
}

.form-control,
.form-select {
    height: 52px;
    border-radius: 12px;
    border: 1px solid var(--border-color);
    background: var(--bg-main);
    transition: all 0.3s ease;
    font-size: 15px;
    color: var(--primary-black);
}

.form-control:hover,
.form-select:hover {
    border-color: #CED4DA;
}

.form-control:focus,
.form-select:focus {
    background: #FFFFFF;
    border-color: var(--primary-black);
    box-shadow: 0 0 0 0.25rem rgba(18, 18, 18, 0.1);
}

/* ================= BUTTON ================= */

.btn-save {
    background: var(--primary-black);
    border: 1px solid var(--primary-black);
    color: white;
    font-weight: 600;
    padding: 12px 28px;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.btn-save:hover {
    background: var(--soft-black);
    color: white;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

.btn-back {
    background: white;
    border: 1px solid #CED4DA;
    color: var(--primary-black);
    font-weight: 600;
    padding: 12px 28px;
    border-radius: 12px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-back:hover {
    background: var(--hover-bg);
    border-color: #ADB5BD;
    color: var(--primary-black);
}

/* ================= BORDER ================= */

.border-top {
    border-color: var(--border-color) !important;
}

/* ================= RESPONSIVE ================= */

@media(max-width: 768px) {
    .page-header {
        padding: 25px;
    }

    .page-header h2 {
        font-size: 1.6rem;
    }

    .header-icon {
        display: none;
    }

    .form-card {
        padding: 25px;
    }
}
</style>

<div class="container py-4">

    <div class="page-header d-flex justify-content-between align-items-center flex-wrap">

        <div class="d-flex align-items-center">

            <div class="header-icon">
                <i class="bi bi-person-plus-fill text-white"></i>
            </div>

            <div>

                <h2 class="serif-font fw-bold">Tambah T-Shirt User Baru</h2>

                <p>
                    Tambahkan akun pengguna T-Shirt baru dan tentukan hak aksesnya.
                </p>

            </div>

        </div>

        <a href="{{ route('admin.users') }}" class="btn btn-back mt-3 mt-md-0">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>

    </div>

    <div class="form-card">

        <form action="{{ route('admin.users.store') }}" method="POST">

            @csrf

            @include('users._form')

            <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top">

                <a href="{{ route('admin.users') }}" class="btn btn-back">
                    Batal
                </a>

                <button type="submit" class="btn btn-save">
                    <i class="bi bi-check-circle me-1"></i> Simpan T-Shirt User
                </button>

            </div>

        </form>

    </div>

</div>

@endsection     