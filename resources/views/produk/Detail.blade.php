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
    --bg-main: #F8F9FA;
    --card-bg: #FFFFFF;
    --primary-black: #121212;
    --soft-black: #2B2B2B;
    --accent-gray: #343A40;
    --text-muted: #6C757D;
    --border-color: #E9ECEF;
    --hover-bg: #F1F3F5;
  }

  body {
    background-color: var(--bg-main);
    color: var(--primary-black);
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  .serif-font {
    font-family: 'Cinzel', serif;
    letter-spacing: 0.5px;
  }

  /* Header Section */
  .page-header {
    background: linear-gradient(135deg, #121212 0%, #2B2B2B 100%);
    border-radius: 16px;
    padding: 2.2rem 2.5rem;
    color: #FFFFFF;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    margin-bottom: 2.5rem;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.1);
  }

  .page-header::after {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, rgba(0,0,0,0) 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  /* Detail Card Container */
  .detail-card {
    background: var(--card-bg);
    border-radius: 16px;
    border: 1px solid var(--border-color);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    overflow: hidden;
  }

  /* Product Image Area */
  .product-image-box {
    background: var(--bg-main);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2.5rem;
    min-height: 100%;
    border-right: 1px solid var(--border-color);
  }

  .product-image-box img {
    width: 100%;
    max-width: 320px;
    border-radius: 12px;
    border: 1px solid var(--border-color);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
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
    background: var(--bg-main);
    color: var(--primary-black);
    border: 1px solid var(--border-color);
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
    color: var(--primary-black);
    margin-bottom: 1.5rem;
  }

  .info-card {
    background: var(--bg-main);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 1.25rem 1.5rem;
  }

  .info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.85rem 0;
    border-bottom: 1px dashed var(--border-color);
  }

  .info-item:last-child {
    border-bottom: none;
  }

  .info-label {
    color: var(--text-muted);
    font-size: 0.875rem;
    font-weight: 600;
  }

  .info-value {
    font-weight: 700;
    font-size: 1rem;
    color: var(--primary-black);
  }

  /* Monochromatic Badges */
  .badge-stock-good {
    background-color: #E9ECEF;
    color: var(--primary-black);
    border: 1px solid #CED4DA;
    padding: 5px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.8rem;
  }

  .badge-stock-low {
    background-color: var(--primary-black);
    color: #FFFFFF;
    border: 1px solid var(--primary-black);
    padding: 5px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.8rem;
  }

  /* Buttons */
  .btn-back-mono {
    background-color: #FFFFFF;
    color: var(--primary-black) !important;
    border: 1px solid var(--border-color);
    border-radius: 10px;
    padding: 0.65rem 1.4rem;
    font-weight: 600;
    transition: all 0.2s ease;
  }

  .btn-back-mono:hover {
    background-color: var(--bg-main);
    border-color: #CED4DA;
  }

  .btn-edit-mono {
    background-color: var(--primary-black);
    color: #FFFFFF !important;
    border: 1px solid var(--primary-black);
    border-radius: 10px;
    padding: 0.65rem 1.4rem;
    font-weight: 600;
    transition: all 0.2s ease;
  }

  .btn-edit-mono:hover {
    background-color: var(--accent-gray);
    border-color: var(--accent-gray);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  @media(max-width: 991px) {
    .product-image-box {
      border-right: none;
      border-bottom: 1px solid var(--border-color);
      min-height: 280px;
    }
  }
</style>

<div class="container my-4">

  {{-- Header Section --}}
  <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
      <h2 class="serif-font fw-bold m-0 fs-2">Detail Produk</h2>
      <p class="text-white-50 m-0 mt-1">Rincian informasi produk dan inventaris.</p>
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
            <div class="text-center text-muted py-5">
              <i class="bi bi-image display-1 text-secondary opacity-50"></i>
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
            <div class="info-item">
              <span class="info-label">Harga Beli</span>
              <span class="info-value">
                Rp {{ number_format($produk->harga_beli ?? $produk->purchase_price ?? 0, 0, ',', '.') }}
              </span>
            </div>

            <div class="info-item">
              <span class="info-label">Harga Jual</span>
              <span class="info-value text-dark">
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
                <i class="bi bi-person-circle me-1 text-muted"></i>
                {{ $produk->user->name ?? 'Sistem' }}
              </span>
            </div>
          </div>

          {{-- Action Buttons --}}
          <div class="d-flex gap-2">
            <a href="{{ route('produk.index') }}" class="btn btn-back-mono text-decoration-none">
              Kembali
            </a>

            @if(Route::has('produk.edit'))
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

@endsection