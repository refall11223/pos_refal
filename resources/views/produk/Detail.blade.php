@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

@include('layouts.navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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

  /* Ornamen Glow Kaca */
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
    padding: 2.2rem 2.5rem;
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
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.25) 0%, rgba(0,0,0,0) 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  /* Detail Card Container Glassmorphism */
  .detail-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 18px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
    overflow: hidden;
  }

  /* Product Image Area */
  .product-image-box {
    background: rgba(15, 23, 42, 0.4);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2.5rem;
    min-height: 100%;
    border-right: 1px solid rgba(255, 255, 255, 0.12);
  }

  .product-image-box img {
    width: 100%;
    max-width: 320px;
    border-radius: 14px;
    border: 1px solid rgba(255, 255, 255, 0.18);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .product-image-box img:hover {
    transform: scale(1.03);
  }

  /* Product Info Area */
  .product-info {
    padding: 2.5rem;
  }

  .product-id-badge {
    display: inline-block;
    background: rgba(37, 99, 235, 0.2);
    color: #93C5FD;
    border: 1px solid rgba(37, 99, 235, 0.35);
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .product-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #FFFFFF;
    margin-bottom: 1.5rem;
  }

  .info-card {
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 14px;
    padding: 1.25rem 1.5rem;
  }

  .info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.85rem 0;
    border-bottom: 1px dashed rgba(255, 255, 255, 0.12);
  }

  .info-item:last-child {
    border-bottom: none;
  }

  .info-label {
    color: var(--color-gray);
    font-size: 0.875rem;
    font-weight: 600;
  }

  .info-value {
    font-weight: 700;
    font-size: 1rem;
    color: #FFFFFF;
  }

  /* Glassmorphism Badges */
  .badge-stock-good {
    background-color: rgba(37, 99, 235, 0.25);
    color: #93C5FD;
    border: 1px solid rgba(37, 99, 235, 0.4);
    padding: 5px 14px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.8rem;
  }

  .badge-stock-low {
    background-color: rgba(239, 68, 68, 0.2);
    color: #FCA5A5;
    border: 1px solid rgba(239, 68, 68, 0.35);
    padding: 5px 14px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.8rem;
  }

  /* Buttons */
  .btn-back-mono {
    background-color: rgba(255, 255, 255, 0.08) !important;
    color: #FFFFFF !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 12px;
    padding: 0.65rem 1.4rem;
    font-weight: 600;
    transition: all 0.2s ease;
  }

  .btn-back-mono:hover {
    background-color: rgba(255, 255, 255, 0.18) !important;
    border-color: rgba(255, 255, 255, 0.35) !important;
    color: #FFFFFF !important;
  }

  .btn-edit-mono {
    background-color: var(--color-blue) !important;
    color: #FFFFFF !important;
    border: 1px solid rgba(37, 99, 235, 0.5) !important;
    border-radius: 12px;
    padding: 0.65rem 1.4rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
  }

  .btn-edit-mono:hover {
    background-color: #1D4ED8 !important;
    border-color: #1D4ED8 !important;
    color: #FFFFFF !important;
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    transform: translateY(-2px);
  }

  @media(max-width: 991px) {
    .product-image-box {
      border-right: none;
      border-bottom: 1px solid rgba(255, 255, 255, 0.12);
      min-height: 280px;
    }
  }
</style>

<div class="dashboard-wrapper">
  <div class="container my-5">

    {{-- Header Section --}}
    <div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap gap-3">
      <div>
        <h2 class="serif-font fw-bold m-0 fs-2">Detail Produk</h2>
        <p class="text-white-50 m-0 mt-1 fs-6">Rincian informasi produk dan inventaris.</p>
      </div>
      <div>
        <a href="{{ route('produk.index') }}" class="btn btn-back-mono text-decoration-none">
          <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
      </div>
    </div>

    {{-- Detail Content Card --}}
    <div class="detail-card">
      <div class="row g-0">
        
        {{-- Gambar Produk --}}
        <div class="col-lg-5">
          <div class="product-image-box">
            @if($produk->foto)
              <img src="{{ asset('storage/'.$produk->foto) }}" alt="{{ $produk->nama ?? $produk->name }}">
            @else
              <div class="text-center text-white-50 py-5">
                <i class="bi bi-image display-1 text-white-50 opacity-50"></i>
                <p class="mt-2 fw-semibold">Tidak Ada Gambar</p>
              </div>
            @endif
          </div>
        </div>

        {{-- Detail Informasi --}}
        <div class="col-lg-7">
          <div class="product-info">
            
            <span class="product-id-badge">
              <i class="bi bi-hash"></i> {{ $produk->id }}
            </span>

            <h2 class="product-title">
              {{ $produk->nama ?? $produk->name ?? '-' }}
            </h2>

            <div class="info-card mb-4">
              
              {{-- Harga Beli hanya muncul jika user adalah Admin --}}
              @if(auth()->check() && auth()->user()->role === 'admin')
                <div class="info-item">
                  <span class="info-label">Harga Beli</span>
                  <span class="info-value">
                    Rp {{ number_format($produk->harga_beli ?? $produk->purchase_price ?? 0, 0, ',', '.') }}
                  </span>
                </div>
              @endif

              <div class="info-item">
                <span class="info-label">Harga Jual</span>
                <span class="info-value text-white">
                  Rp {{ number_format($produk->harga_jual ?? $produk->selling_price ?? 0, 0, ',', '.') }}
                </span>
              </div>

              <div class="info-item">
                <span class="info-label">Stok Tersedia</span>
                @if(($produk->stok ?? $produk->stock ?? 0) > 5)
                  <span class="badge-stock-good">
                    <i class="bi bi-check2 me-1"></i>{{ $produk->stok ?? $produk->stock }} pcs
                  </span>
                @else
                  <span class="badge-stock-low">
                    <i class="bi bi-exclamation-triangle me-1"></i>{{ $produk->stok ?? $produk->stock ?? 0 }} pcs
                  </span>
                @endif
              </div>

              <div class="info-item">
                <span class="info-label">Penginput</span>
                <span class="info-value">
                  <i class="bi bi-person-circle me-1 text-white-50"></i>
                  {{ $produk->user->name ?? 'Sistem' }}
                </span>
              </div>
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex gap-2">
              <a href="{{ route('produk.index') }}" class="btn btn-back-mono text-decoration-none">
                Kembali
              </a>

              {{-- Tombol Edit hanya muncul jika user adalah Admin --}}
              @if(auth()->check() && auth()->user()->role === 'admin' && Route::has('produk.edit'))
                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-edit-mono text-decoration-none d-inline-flex align-items-center gap-2">
                  <i class="bi bi-pencil-square"></i> Edit Produk
                </a>
              @endif
            </div>

          </div>
        </div>

      </div>
    </div>

  </div>
</div>

@endsection