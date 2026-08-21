@extends('layouts.app')

@section('title', 'Edit Data User')

@section('content')

@include('layouts.navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    background: linear-gradient(135deg, #1E3A8A 0%, var(--color-black) 100%);
    color: #FFFFFF;
    min-height: 100vh;
  }

  .serif-font {
    font-family: 'Cinzel', serif;
    letter-spacing: 0.5px;
  }

  /* Ornamen Glow Kaca pada Background Container */
  .dashboard-wrapper {
    position: relative;
    overflow: hidden;
  }

  .dashboard-wrapper::before {
    content: '';
    position: absolute;
    top: -80px;
    left: -80px;
    width: 350px;
    height: 350px;
    background: rgba(37, 99, 235, 0.35);
    filter: blur(100px);
    border-radius: 50%;
    pointer-events: none;
  }

  .dashboard-wrapper::after {
    content: '';
    position: absolute;
    bottom: -80px;
    right: -80px;
    width: 350px;
    height: 350px;
    background: rgba(15, 23, 42, 0.8);
    filter: blur(100px);
    border-radius: 50%;
    pointer-events: none;
  }

  /* Header Section Glassmorphism */
  .dashboard-header {
    background: rgba(255, 255, 255, 0.06);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-radius: 20px;
    padding: 2.5rem;
    color: #FFFFFF;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    margin-bottom: 2.5rem;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.15);
  }

  .dashboard-header::after {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 220px;
    height: 220px;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.25) 0%, rgba(0,0,0,0) 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  .header-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    background: rgba(37, 99, 235, 0.2);
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 26px;
    color: #60A5FA;
    border: 1px solid rgba(37, 99, 235, 0.4);
  }

  /* Form Card Container Glassmorphism */
  .form-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 20px;
    padding: 2.5rem;
    max-width: 900px;
    margin: 0 auto;
    border: 1px solid rgba(255, 255, 255, 0.12);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
  }

  /* Form Elements Glassmorphism Style */
  .form-label {
    color: #FFFFFF;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.9rem;
  }

  .form-control,
  .form-select {
    height: 50px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    background-color: rgba(15, 23, 42, 0.4);
    color: #FFFFFF;
    transition: all 0.3s ease;
    font-size: 0.95rem;
  }

  .form-control::placeholder {
    color: var(--color-gray);
  }

  .form-control:hover,
  .form-select:hover {
    border-color: rgba(255, 255, 255, 0.3);
  }

  .form-control:focus,
  .form-select:focus {
    background-color: rgba(15, 23, 42, 0.6);
    border-color: var(--color-blue);
    color: #FFFFFF;
    box-shadow: 0 0 12px rgba(37, 99, 235, 0.3);
  }

  .form-select option {
    background-color: var(--color-black);
    color: #FFFFFF;
  }

  /* Buttons */
  .btn-update {
    background-color: var(--color-blue);
    border: 1px solid rgba(37, 99, 235, 0.5);
    color: #FFFFFF;
    font-weight: 600;
    padding: 12px 28px;
    border-radius: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
  }

  .btn-update:hover {
    background-color: #1D4ED8;
    color: #FFFFFF;
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    transform: translateY(-2px);
  }

  .btn-back {
    background-color: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #FFFFFF;
    font-weight: 600;
    padding: 12px 28px;
    border-radius: 12px;
    transition: all 0.3s ease;
    text-decoration: none;
  }

  .btn-back:hover {
    background-color: rgba(255, 255, 255, 0.18);
    color: #FFFFFF;
    border-color: rgba(255, 255, 255, 0.35);
  }

  /* Divider Border */
  .border-top-glass {
    border-top: 1px solid rgba(255, 255, 255, 0.12) !important;
  }

  @media(max-width: 768px) {
    .dashboard-header {
      padding: 1.5rem;
    }

    .form-card {
      padding: 1.5rem;
    }
  }
</style>

<div class="dashboard-wrapper">
  <div class="container my-5">

    <div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap gap-3">
      <div class="d-flex align-items-center gap-3">
        <div class="header-icon d-none d-sm-flex">
          <i class="bi bi-pencil-square"></i>
        </div>
        <div>
          <h2 class="serif-font fw-bold m-0 fs-2">Edit Data User</h2>
          <p class="text-white-50 m-0 mt-1 fs-6">
            Perbarui informasi akun <strong class="text-white">{{ $user->name }}</strong> dan hak akses pengguna.
          </p>
        </div>
      </div>

      <a href="{{ route('admin.users') }}" class="btn btn-back mt-3 mt-md-0">
        <i class="bi bi-arrow-left me-1"></i> Kembali
      </a>
    </div>

    <div class="form-card">
      <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('users._form')

        <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top-glass">
          <a href="{{ route('admin.users') }}" class="btn btn-back">
            Kembali
          </a>

          {{-- Tombol simpan perubahan hanya diproses/ditampilkan untuk Admin --}}
          @if(optional(auth()->user()->role)->name === 'admin' || auth()->user()->role === 'admin')
            <button type="submit" class="btn btn-update">
              <i class="bi bi-arrow-repeat me-1"></i> Perbarui Data User
            </button>
          @endif
        </div>
      </form>
    </div>

  </div>
</div>

@endsection