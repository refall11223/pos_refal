@extends('layouts.app')

@section('title', 'Point of Sale (POS)')

@section('content')

@include('layouts.navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  :root {
    --bg-main: #f8f9fa;
    --card-bg: #ffffff;
    --border-gray: #e9ecef;
    --dark-primary: #121212;
    --dark-secondary: #212529;
    --gray-muted: #6c757d;
    --gray-light: #f1f3f5;
  }

  body {
    background-color: var(--bg-main);
    color: var(--dark-secondary);
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  /* Header Section */
  .page-header {
    background: linear-gradient(135deg, #1c1e21 0%, #343a40 100%);
    border-radius: 16px;
    padding: 2rem 2.5rem;
    color: #ffffff;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    margin-bottom: 2rem;
  }

  .status-badge {
    background: #ffffff;
    color: var(--dark-primary);
    padding: 8px 20px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 0.9rem;
  }

  /* Main Cards */
  .pos-card {
    background: var(--card-bg);
    border: 1px solid var(--border-gray);
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    overflow: hidden;
  }

  .pos-card-header {
    background: var(--gray-light);
    border-bottom: 1px solid var(--border-gray);
    padding: 1.25rem 1.5rem;
  }

  /* Search Input */
  .pos-search {
    border-radius: 10px;
    border: 1px solid var(--border-gray);
    padding: 0.75rem 1.25rem;
    font-size: 0.95rem;
    background-color: #ffffff;
  }

  .pos-search:focus {
    border-color: var(--dark-primary);
    box-shadow: 0 0 0 0.2rem rgba(33, 37, 41, 0.15);
  }

  /* Product Items */
  .product-item-card {
    background: #ffffff;
    border: 1px solid var(--border-gray);
    border-radius: 12px;
    padding: 1rem;
    transition: all 0.2s ease;
  }

  .product-item-card:hover {
    border-color: var(--dark-primary);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  }

  .product-thumb-pos {
    width: 65px;
    height: 65px;
    border-radius: 8px;
    object-fit: cover;
    border: 1px solid var(--border-gray);
  }

  .product-thumb-placeholder {
    width: 65px;
    height: 65px;
    border-radius: 8px;
    background-color: var(--gray-light);
    color: var(--dark-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    border: 1px dashed #adb5bd;
  }

  .price-tag {
    background: var(--gray-light);
    color: var(--dark-primary);
    padding: 4px 10px;
    border-radius: 6px;
    font-weight: 700;
    font-size: 0.9rem;
  }

  .qty-input-pos {
    border-radius: 8px;
    border: 1px solid var(--border-gray);
    text-align: center;
    font-weight: 600;
  }

  .btn-add-pos {
    background: var(--dark-primary);
    border: none;
    border-radius: 8px;
    color: #ffffff;
    font-weight: 600;
    transition: all 0.2s ease;
  }

  .btn-add-pos:hover {
    background: #343a40;
    color: #ffffff;
  }

  /* Cart Area */
  .cart-table thead th {
    background: var(--gray-light);
    border: none;
    color: var(--dark-secondary);
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 12px 14px;
    font-weight: 700;
  }

  .cart-table tbody td {
    padding: 12px 14px;
    border-bottom: 1px solid var(--border-gray);
    font-size: 0.9rem;
  }

  /* Total Section */
  .total-display-card {
    background: var(--dark-primary);
    border-radius: 12px;
    padding: 1.5rem;
    color: #ffffff;
    text-align: center;
  }

  .btn-checkout {
    background: var(--dark-primary);
    border: none;
    border-radius: 10px;
    color: #ffffff;
    font-weight: 700;
    padding: 0.8rem;
    font-size: 1rem;
    transition: all 0.2s ease;
  }

  .btn-checkout:hover {
    background: #343a40;
    color: #ffffff;
  }

  .btn-cancel-pos {
    border-radius: 10px;
    font-weight: 600;
    padding: 0.7rem;
    border-color: #dc3545;
    color: #dc3545;
  }

  .btn-cancel-pos:hover {
    background-color: #dc3545;
    color: #ffffff;
  }
</style>

<div class="container-fluid px-4 my-4">

  @if(session('errors'))
  <div class="alert alert-dark alert-dismissible fade show rounded-3 mb-4" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('errors') }}
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  {{-- Header --}}
  <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
      <h2 class="fw-bold m-0 fs-2">
        <i class="bi bi-calculator me-2"></i>{{ isset($mode) && $mode == 'edit' ? 'Edit Penjualan' : 'Kasir / Point of Sale' }}
      </h2>
      <p class="text-white-50 m-0 mt-1">
        Pilih produk dan selesaikan transaksi dengan cepat.
      </p>
    </div>

    <div class="status-badge">
      Status : 
      <span class="fw-bold">
        {{ $sale->status ?? 'OPEN' }}
      </span>
    </div>
  </div>

  <div class="row g-4">
    {{-- KATALOG PRODUK --}}
    <div class="col-lg-7">
      <div class="pos-card h-100 d-flex flex-column">
        <div class="pos-card-header d-flex justify-content-between align-items-center">
          <h5 class="fw-bold m-0 text-dark">
            <i class="bi bi-grid me-2"></i>Katalog Produk
          </h5>
          <small class="text-muted">Klik item untuk menambah ke keranjang</small>
        </div>

        <div class="card-body p-4 d-flex flex-column flex-grow-1">
          <form method="GET" action="{{ route('penjualan.create') }}" class="mb-4">
            <div class="position-relative">
              <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
              <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control pos-search ps-5"
                placeholder="Cari produk..."
                onkeyup="this.form.submit()">
            </div>
          </form>

          <div class="flex-grow-1" style="max-height: 600px; overflow-y: auto; padding-right: 4px;">
            <div class="row g-3">
              @forelse($products as $product)
              <div class="col-12">
                <form action="{{ route('itempenjualan.store') }}" method="POST" class="product-item-card">
                  @csrf
                  <input type="hidden" name="produk_id" value="{{ $product->id }}">

                  <div class="row align-items-center g-3">
                    {{-- Foto --}}
                    <div class="col-auto">
                      @if($product->foto)
                        <img src="{{ asset('storage/'.$product->foto) }}" class="product-thumb-pos" alt="{{ $product->nama }}">
                      @else
                        <div class="product-thumb-placeholder">
                          <i class="bi bi-box-seam"></i>
                        </div>
                      @endif
                    </div>

                    {{-- Nama & Harga --}}
                    <div class="col">
                      <h6 class="fw-bold mb-1 text-dark fs-6">{{ $product->nama }}</h6>
                      <span class="price-tag">
                        Rp {{ number_format($product->harga_jual ?? 0, 0, ',', '.') }}
                      </span>
                    </div>

                    {{-- Qty & Button --}}
                    <div class="col-auto d-flex align-items-center gap-2">
                      <input
                        type="number"
                        name="quantity"
                        value="1"
                        min="1"
                        class="form-control qty-input-pos"
                        style="width: 70px;"
                        {{ ($sale->status ?? '') == 'COMPLETED' ? 'disabled' : '' }}>

                      <button
                        class="btn btn-add-pos px-3 py-2 {{ ($sale->status ?? '') == 'COMPLETED' ? 'disabled' : '' }}"
                        type="submit"
                        title="Tambah ke Keranjang">
                        <i class="bi bi-plus-lg"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              @empty
              <div class="col-12 text-center py-5">
                <i class="bi bi-search display-4 text-muted mb-3 d-block"></i>
                <h5 class="text-secondary fw-semibold">Produk tidak ditemukan</h5>
                <p class="text-muted small">Coba masukkan kata kunci pencarian lain.</p>
              </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- KERANJANG BELANJA --}}
    <div class="col-lg-5">
      <div class="pos-card h-100 d-flex flex-column justify-content-between">
        <div>
          <div class="pos-card-header d-flex justify-content-between align-items-center">
            <h5 class="fw-bold m-0 text-dark">
              <i class="bi bi-cart3 me-2"></i>Keranjang Belanja
            </h5>
            <span class="badge bg-dark rounded-pill px-3 py-2">
              {{ count($sale->itempenjualan ?? []) }} Item
            </span>
          </div>

          <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table cart-table align-middle mb-0">
              <thead>
                <tr>
                  <th>Produk</th>
                  <th width="100" class="text-center">Qty</th>
                  <th class="text-end">Subtotal</th>
                  <th width="40"></th>
                </tr>
              </thead>
              <tbody>
                @forelse($sale->itempenjualan ?? [] as $item)
                <tr>
                  <td>
                    <div class="fw-bold text-dark">{{ $item->produk->nama ?? 'Produk Dihapus' }}</div>
                    <small class="text-muted">
                      Rp {{ number_format($item->produk->harga_jual ?? $item->harga_satuan ?? 0, 0, ',', '.') }}
                    </small>
                  </td>

                  <td>
                    <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                      @csrf
                      @method('PUT')
                      <input
                        type="number"
                        name="quantity"
                        value="{{ $item->kuantitas }}"
                        min="1"
                        class="form-control qty-input-pos form-control-sm"
                        onchange="this.form.submit()"
                        {{ ($sale->status ?? '') == 'COMPLETED' ? 'disabled' : '' }}>
                    </form>
                  </td>

                  <td class="text-end fw-bold text-dark">
                    Rp {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}
                  </td>

                  <td class="text-center">
                    @can('delete', $item)
                    <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-link text-dark p-0" title="Hapus Item">
                        <i class="bi bi-trash fs-6"></i>
                      </button>
                    </form>
                    @endcan
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="text-center py-5">
                    <i class="bi bi-cart-x display-4 text-muted mb-2 d-block"></i>
                    <h6 class="text-muted fw-semibold">Keranjang masih kosong</h6>
                    <small class="text-muted">Pilih produk dari katalog di sebelah kiri.</small>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        {{-- TOTAL PEMBAYARAN & CHECKOUT --}}
        <div class="p-4 border-top bg-light">
          <div class="total-display-card mb-4">
            <span class="text-white-50 text-uppercase fw-bold fs-7">Total Tagihan</span>
            <h3 class="fw-bold m-0 mt-1 fs-1">
              Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}
            </h3>
          </div>

          <form
            method="POST"
            action="{{ route('penjualan.update', $sale->id) }}"
            onsubmit="return confirm('Selesaikan transaksi dan lakukan checkout?')">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label fw-bold text-dark small">
                <i class="bi bi-credit-card me-1"></i> Metode Pembayaran
              </label>
              <select
                name="payment_method"
                class="form-select"
                required
                {{ ($sale->status ?? '') == 'COMPLETED' ? 'disabled' : '' }}>
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="CASH">💵 Cash / Tunai</option>
                <option value="QRIS">📱 QRIS / Non Tunai</option>
              </select>
            </div>

            <button
              type="submit"
              class="btn btn-checkout w-100 {{ ($sale->status ?? '') == 'COMPLETED' ? 'disabled' : '' }}">
              <i class="bi bi-check-circle me-2"></i>Checkout & Selesaikan
            </button>
          </form>

          @can('delete', $sale)
          <form
            action="{{ route('penjualan.destroy', $sale->id) }}"
            method="POST"
            class="mt-2"
            onsubmit="return confirm('Apakah Anda yakin ingin membatalkan transaksi ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-cancel-pos w-100 btn-sm">
              <i class="bi bi-x-circle me-1"></i>Batalkan Transaksi
            </button>
          </form>
          @endcan
        </div>
      </div>
    </div>
  </div>

</div>

@endsection