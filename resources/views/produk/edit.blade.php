@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

@include('layouts.navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  :root {
    --color-blue: #2563EB;
    --color-blue-glow: rgba(37, 99, 235, 0.4);
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

  /* Ornaments & Background Glow */
  .dashboard-wrapper {
    position: relative;
    overflow: hidden;
    padding-bottom: 3rem;
  }

  .dashboard-wrapper::before {
    content: '';
    position: absolute;
    top: -100px;
    left: -100px;
    width: 400px;
    height: 400px;
    background: var(--color-blue-glow);
    filter: blur(120px);
    border-radius: 50%;
    pointer-events: none;
  }

  .dashboard-wrapper::after {
    content: '';
    position: absolute;
    bottom: -100px;
    right: -100px;
    width: 400px;
    height: 400px;
    background: rgba(15, 23, 42, 0.9);
    filter: blur(120px);
    border-radius: 50%;
    pointer-events: none;
  }

  /* Glassmorphism Header */
  .dashboard-header {
    background: rgba(255, 255, 255, 0.06);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 2.2rem 2.5rem;
    color: #FFFFFF;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
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
    background: radial-gradient(circle, rgba(37, 99, 235, 0.3) 0%, rgba(0,0,0,0) 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  .header-icon-box {
    width: 54px;
    height: 54px;
    background: rgba(37, 99, 235, 0.2);
    border: 1px solid rgba(37, 99, 235, 0.4);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: #93C5FD;
    box-shadow: 0 0 15px var(--color-blue-glow);
  }

  /* Glassmorphism Form Container */
  .form-card {
    background: rgba(255, 255, 255, 0.04);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    padding: 2.5rem;
    max-width: 900px;
    margin: auto;
    position: relative;
    z-index: 1;
  }

  .product-badge {
    background: rgba(37, 99, 235, 0.2);
    color: #93C5FD;
    border: 1px solid rgba(37, 99, 235, 0.35);
    padding: 2px 10px;
    border-radius: 6px;
    font-size: 0.85rem;
  }

  /* Custom Input Glass Overrides */
  .form-label {
    color: #FFFFFF;
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    letter-spacing: 0.3px;
  }

  .form-control,
  .form-select,
  textarea {
    border: 1px solid rgba(255, 255, 255, 0.15) !important;
    border-radius: 12px !important;
    background-color: rgba(15, 23, 42, 0.5) !important;
    color: #FFFFFF !important;
    padding: 0.75rem 1rem !important;
    transition: all 0.25s ease-in-out !important;
    font-size: 0.95rem !important;
  }

  .form-control::placeholder,
  textarea::placeholder {
    color: var(--color-gray) !important;
  }

  .form-control:focus,
  .form-select:focus,
  textarea:focus {
    background-color: rgba(15, 23, 42, 0.7) !important;
    border-color: var(--color-blue) !important;
    box-shadow: 0 0 15px var(--color-blue-glow) !important;
    color: #FFFFFF !important;
  }

  .form-select option {
    background-color: var(--color-black);
    color: #FFFFFF;
  }

  /* Buttons */
  .btn-back-glass {
    background-color: rgba(255, 255, 255, 0.08) !important;
    color: #FFFFFF !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 12px;
    padding: 0.7rem 1.4rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .btn-back-glass:hover {
    background-color: rgba(255, 255, 255, 0.18) !important;
    border-color: rgba(255, 255, 255, 0.35) !important;
    color: #FFFFFF !important;
    transform: translateY(-2px);
  }

  @media(max-width: 768px) {
    .dashboard-header,
    .form-card {
      padding: 1.5rem;
    }
  }
</style>

<div class="dashboard-wrapper">
  <div class="container my-5">

    {{-- Header Section --}}
    <div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap gap-3">
      <div class="d-flex align-items-center gap-3">
        <div class="header-icon-box">
          <i class="bi bi-pencil-square"></i>
        </div>
        <div>
          <h2 class="serif-font fw-bold m-0 fs-2">Edit Produk</h2>
          <p class="text-white-50 m-0 mt-1 fs-6">
            Perbarui data <span class="product-badge fw-semibold">{{ $produk->nama ?? $produk->name }}</span> agar informasi inventaris selalu tepat.
          </p>
        </div>
      </div>
      <div>
        <a href="{{ route('produk.index') }}" class="btn btn-back-glass">
          <i class="bi bi-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    {{-- Form Card --}}
    <div class="form-card">
      <form action="{{ route('produk.update', $produk) }}"
            method="POST"
            enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- Mengambil partial form yang sudah memiliki style Glassmorphism --}}
        @include('Produk._form')

      </form>
    </div>

  </div>
</div>

@endsection