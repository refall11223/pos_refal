@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

{{-- Import Font Clean & Professional --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Roboto+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  :root {
    --color-blue: #2563EB;
    --color-black: #0F172A;
    --color-gray: #94A3B8;
  }

  * {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
  }

  body {
    background: linear-gradient(135deg, #1E3A8A 0%, var(--color-black) 100%);
    color: #FFFFFF;
    min-height: 100vh;
  }

  /* Header Section */
  .dashboard-header {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 16px;
    padding: 1.5rem 2rem;
    color: #FFFFFF;
    margin-bottom: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.12);
  }

  .header-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(37, 99, 235, 0.2);
    border: 1px solid rgba(37, 99, 235, 0.4);
    color: #93C5FD;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
  }

  .brand-title {
    font-size: 1.5rem;
    font-weight: 700;
    letter-spacing: -0.3px;
    color: #FFFFFF;
    margin-bottom: 0.25rem;
  }

  .text-description {
    font-size: 0.875rem;
    color: #94A3B8;
    font-weight: 400;
  }

  /* Back Button */
  .btn-back {
    background: rgba(255, 255, 255, 0.08);
    color: #E2E8F0;
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 8px;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .btn-back:hover {
    background: rgba(255, 255, 255, 0.18);
    color: #FFFFFF;
  }

  /* Main Glass Card */
  .luxury-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    padding: 1.5rem;
    margin-bottom: 2rem;
  }

  /* Transaction Summary Grid */
  .transaction-info {
    display: flex;
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 12px;
    overflow: hidden;
    margin-top: 1rem;
    margin-bottom: 2rem;
  }

  .info-item {
    flex: 1;
    padding: 1.25rem;
    border-right: 1px solid rgba(255, 255, 255, 0.08);
  }

  .info-item:last-child {
    border-right: none;
  }

  .info-label {
    display: block;
    color: #94A3B8;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.35rem;
  }

  .info-value {
    color: #FFFFFF;
    font-size: 0.95rem;
    font-weight: 600;
  }

  .info-value.total {
    color: #86EFAC;
    font-size: 1.15rem;
  }

  .font-number {
    font-family: 'Roboto Mono', monospace;
  }

  /* Product List */
  .product-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
  }

  .product-heading h4 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 700;
    color: #FFFFFF;
  }

  .product-heading span {
    color: #94A3B8;
    font-size: 0.8rem;
  }

  .product-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.875rem 1rem;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    margin-bottom: 0.75rem;
    background: rgba(255, 255, 255, 0.03);
    transition: all 0.2s ease;
  }

  .product-item:hover {
    background: rgba(255, 255, 255, 0.06);
    border-color: rgba(255, 255, 255, 0.15);
  }

  .product-number {
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(37, 99, 235, 0.2);
    color: #93C5FD;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    flex-shrink: 0;
  }

  .product-image {
    width: 55px;
    height: 55px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    flex-shrink: 0;
  }

  .product-placeholder {
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(15, 23, 42, 0.6);
    border-radius: 8px;
    color: #64748B;
    font-size: 1.25rem;
    flex-shrink: 0;
  }

  .product-detail {
    flex: 1;
  }

  .product-name {
    font-size: 0.9rem;
    font-weight: 600;
    color: #FFFFFF;
  }

  .product-id {
    margin-top: 2px;
    font-size: 0.75rem;
    color: #94A3B8;
  }

  .product-qty {
    text-align: center;
    width: 70px;
  }

  .qty-label {
    display: block;
    font-size: 0.65rem;
    color: #94A3B8;
    text-transform: uppercase;
    margin-bottom: 2px;
  }

  .qty-value {
    display: inline-flex;
    min-width: 28px;
    height: 24px;
    align-items: center;
    justify-content: center;
    background: rgba(37, 99, 235, 0.2);
    color: #93C5FD;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
  }

  .product-price {
    width: 130px;
    text-align: right;
  }

  .price-label {
    display: block;
    font-size: 0.65rem;
    color: #94A3B8;
    margin-bottom: 2px;
  }

  .price-value {
    font-size: 0.85rem;
    font-weight: 500;
    color: #E2E8F0;
  }

  .product-total {
    width: 140px;
    text-align: right;
  }

  .total-label {
    display: block;
    font-size: 0.65rem;
    color: #94A3B8;
    margin-bottom: 2px;
  }

  .total-value {
    font-size: 0.95rem;
    font-weight: 700;
    color: #86EFAC;
  }

  /* Total Area */
  .total-area {
    margin-top: 1.5rem;
    display: flex;
    justify-content: flex-end;
  }

  .total-box {
    width: 320px;
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.15);
  }

  .total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .total-row span:first-child {
    font-size: 0.875rem;
    font-weight: 600;
    color: #94A3B8;
  }

  .final-total {
    color: #86EFAC;
    font-size: 1.35rem;
    font-weight: 800;
  }

  /* Footer Section */
  .invoice-footer {
    margin-top: 1.5rem;
    padding: 1rem 1.25rem;
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .success-message {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .success-icon {
    width: 36px;
    height: 36px;
    background: rgba(34, 197, 94, 0.2);
    color: #86EFAC;
    border: 1px solid rgba(34, 197, 94, 0.4);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
  }

  .success-title {
    margin: 0;
    font-size: 0.875rem;
    font-weight: 700;
    color: #FFFFFF;
  }

  .success-text {
    margin: 2px 0 0;
    font-size: 0.75rem;
    color: #94A3B8;
  }

  .empty-product {
    text-align: center;
    padding: 2.5rem 1rem;
    color: #94A3B8;
  }

  /* Responsive */
  @media(max-width: 768px) {
    .transaction-info {
      flex-direction: column;
    }

    .info-item {
      border-right: none;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .info-item:last-child {
      border-bottom: none;
    }

    .product-item {
      flex-wrap: wrap;
    }

    .product-detail {
      min-width: calc(100% - 110px);
    }

    .product-qty, .product-price, .product-total {
      width: auto;
      flex: 1;
      text-align: left;
    }

    .total-box {
      width: 100%;
    }

    .invoice-footer {
      flex-direction: column;
      align-items: flex-start;
      gap: 1rem;
    }
  }
</style>

<div class="container my-4">

  {{-- Header --}}
  <div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
      <div class="header-badge">
        <i class="bi bi-receipt"></i> Penjualan
      </div>
      <h1 class="brand-title">Detail Penjualan</h1>
      <p class="text-description m-0">Informasi lengkap rincian transaksi penjualan produk bouquet.</p>
    </div>

    <a href="{{ route('penjualan.index') }}" class="btn btn-back d-inline-flex align-items-center gap-2">
      <i class="bi bi-arrow-left"></i> Kembali
    </a>
  </div>

  {{-- Main Glass Card --}}
  <div class="luxury-card">
    
    {{-- Ringkasan Informasi Transaksi --}}
    <div class="mb-3">
      <h4 class="fw-bold mb-1 fs-5 text-white">Ringkasan Transaksi</h4>
      <p class="text-description m-0">Informasi umum tanggal dan petugas kasir.</p>

      <div class="transaction-info">
        <div class="info-item">
          <span class="info-label">Kasir / Petugas</span>
          <div class="info-value">
            <i class="bi bi-person me-1 text-white-50"></i>
            {{ $sale->user->name ?? 'Sistem' }}
          </div>
        </div>

        <div class="info-item">
          <span class="info-label">Tanggal Transaksi</span>
          <div class="info-value font-number">
            <i class="bi bi-calendar3 me-1 text-white-50"></i>
            {{ $sale->created_at ? $sale->created_at->translatedFormat('d F Y') : '-' }}
            <span class="text-white-50 ms-1">
              {{ $sale->created_at ? $sale->created_at->format('H:i') . ' WIB' : '' }}
            </span>
          </div>
        </div>

        <div class="info-item">
          <span class="info-label">Metode Pembayaran</span>
          <div class="info-value font-number">
            <span class="badge bg-secondary font-number fs-7">{{ $sale->metode_pembayaran ?? 'CASH' }}</span>
          </div>
        </div>

        <div class="info-item">
          <span class="info-label">Total Pembayaran</span>
          <div class="info-value total font-number">
            Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}
          </div>
        </div>
      </div>
    </div>

    {{-- Daftar Produk --}}
    <div class="product-area">
      <div class="product-heading">
        <h4>Daftar Produk Belanja</h4>
        <span class="font-number">{{ $sale->itemPenjualan ? $sale->itemPenjualan->count() : 0 }} item produk</span>
      </div>

      @forelse($sale->itemPenjualan as $index => $item)
        <div class="product-item">
          <div class="product-number font-number">
            {{ $index + 1 }}
          </div>

          @if($item->produk && $item->produk->foto)
            <img
              src="{{ \Illuminate\Support\Facades\Storage::url($item->produk->foto) }}"
              class="product-image"
              alt="{{ $item->produk->nama }}">
          @else
            <div class="product-placeholder">
              <i class="bi bi-box-seam"></i>
            </div>
          @endif

          <div class="product-detail">
            <div class="product-name">
              {{ $item->produk->nama ?? 'Produk Dihapus' }}
            </div>
            <div class="product-id font-number">
              ID Produk : {{ $item->produk->id ?? '-' }}
            </div>
          </div>

          <div class="product-qty">
            <span class="qty-label">Qty</span>
            <span class="qty-value font-number">{{ $item->kuantitas }}</span>
          </div>

          <div class="product-price">
            <span class="price-label">Harga</span>
            <span class="price-value font-number">
              Rp {{ number_format($item->produk->harga_jual ?? 0, 0, ',', '.') }}
            </span>
          </div>

          <div class="product-total">
            <span class="total-label">Subtotal</span>
            <span class="total-value font-number">
              Rp {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}
            </span>
          </div>
        </div>
      @empty
        <div class="empty-product">
          <i class="bi bi-box-seam fs-2 d-block text-white-50 mb-2"></i>
          <h5 class="text-white fw-semibold mb-1">Tidak Ada Produk</h5>
          <p class="m-0 text-white-50">Tidak ada produk dalam transaksi ini.</p>
        </div>
      @endforelse

      {{-- Total Area --}}
      <div class="total-area">
        <div class="total-box">
          <div class="total-row">
            <span>Total Akhir</span>
            <span class="final-total font-number">
              Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}
            </span>
          </div>
        </div>
      </div>
    </div>

    {{-- Footer Info --}}
    <div class="invoice-footer">
      <div class="success-message">
        <div class="success-icon">
          <i class="bi bi-check-lg"></i>
        </div>
        <div>
          <p class="success-title">Transaksi Selesai</p>
          <p class="success-text">Rincian data transaksi ini telah disimpan dengan aman di sistem.</p>
        </div>
      </div>

      <a href="{{ route('penjualan.index') }}" class="btn btn-back d-inline-flex align-items-center gap-2">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Penjualan
      </a>
    </div>

  </div>

</div>

@endsection