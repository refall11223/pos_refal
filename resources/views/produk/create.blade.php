@extends('layouts.app')

@section('title', 'Tambah Produk T-Shirt')

@section('content')

@include('layouts.navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

  html, body {
    background: #0F172A !important;
    background: linear-gradient(135deg, #1E3A8A 0%, #0F172A 100%) !important;
    color: #FFFFFF !important;
    min-height: 100vh;
  }

  .serif-font {
    font-family: 'Cinzel', serif;
    letter-spacing: 0.5px;
  }

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

  .dashboard-header {
    background: rgba(255, 255, 255, 0.08) !important;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 2.2rem 2.5rem;
    color: #FFFFFF !important;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    margin-bottom: 2.5rem;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.18);
  }

  .category-badge {
    background: rgba(37, 99, 235, 0.3);
    color: #93C5FD;
    border: 1px solid rgba(37, 99, 235, 0.4);
    padding: 2px 10px;
    border-radius: 6px;
    font-size: 0.85rem;
  }

  .form-card {
    background: rgba(30, 41, 59, 0.7) !important;
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    padding: 2.5rem;
    max-width: 900px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }

  .btn-back-glass {
    background-color: rgba(255, 255, 255, 0.1) !important;
    color: #FFFFFF !important;
    border: 1px solid rgba(255, 255, 255, 0.25) !important;
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
    background-color: rgba(255, 255, 255, 0.22) !important;
    border-color: rgba(255, 255, 255, 0.4) !important;
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
      <div>
        <h2 class="serif-font fw-bold m-0 fs-2 text-white">Tambah Produk Baru</h2>
        <p class="text-white-50 m-0 mt-1 fs-6">
          Lengkapi detail artikel <span class="category-badge fw-semibold">T-Shirt</span>, penentuan harga, stok, dan unggah foto katalog.
        </p>
      </div>
      <div>
        <a href="{{ route('produk.index') }}" class="btn btn-back-glass">
          <i class="bi bi-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    {{-- Form Card --}}
    <div class="form-card">
      <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Partial _form --}}
        @include('Produk._form')

      </form>
    </div>

  </div>
</div>

@endsection