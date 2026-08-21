@extends('layouts.app')

@section('title', 'Daftar Produk T-Shirt')

@section('content')

@include('layouts.navbar')

{{-- Import Font Clean & Professional --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Roboto+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  :root {
    --color-blue: #2563EB;
    --color-black: #0F172A;
    --color-gray: #94A3B8;
  }

  /* Base Typography Settings */
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

  /* Main Card Container */
  .luxury-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    padding: 1.25rem;
    margin-bottom: 2rem;
  }

  /* Buttons & Inputs */
  .btn-create {
    background-color: var(--color-blue);
    color: #FFFFFF;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    border: none;
    transition: background-color 0.2s ease;
  }

  .btn-create:hover {
    background-color: #1D4ED8;
    color: #FFFFFF;
  }

  .search-box .form-control {
    border-radius: 8px 0 0 8px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 0.5rem 0.875rem;
    background-color: rgba(15, 23, 42, 0.5) !important;
    color: #FFFFFF !important;
    font-size: 0.875rem;
  }

  .search-box .form-control::placeholder {
    color: var(--color-gray);
  }

  .search-box .form-control:focus {
    box-shadow: none;
    border-color: var(--color-blue);
  }

  .search-box .btn-search {
    background-color: var(--color-blue);
    color: #FFFFFF;
    border-radius: 0 8px 8px 0;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    border: none;
  }

  /* Table Custom */
  .table-responsive {
    overflow-x: auto;
  }

  .table-custom {
    --bs-table-bg: transparent !important;
    --bs-table-color: #FFFFFF !important;
    margin-bottom: 0;
    width: 100%;
  }

  .table-custom thead th {
    background: rgba(15, 23, 42, 0.6) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    color: #94A3B8 !important;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 0.75rem 0.75rem;
  }

  .table-custom tbody td {
    padding: 0.75rem 0.75rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    color: #FFFFFF !important;
    font-size: 0.875rem;
    vertical-align: middle;
  }

  .table-custom tbody tr:hover td {
    background-color: rgba(255, 255, 255, 0.04) !important;
  }

  /* Font Monospace untuk Angka & Harga */
  .font-number {
    font-family: 'Roboto Mono', monospace;
    font-size: 0.85rem;
  }

  /* Gambar Thumbnail */
  .thumb-box {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    overflow: hidden;
    background-color: rgba(15, 23, 42, 0.6);
    border: 1px solid rgba(255, 255, 255, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
  }

  .thumb-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  /* Status Badges */
  .badge-stock-safe,
  .badge-stock-low {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 500;
  }

  .badge-stock-safe {
    background-color: rgba(37, 99, 235, 0.2);
    color: #93C5FD;
    border: 1px solid rgba(37, 99, 235, 0.3);
  }

  .badge-stock-low {
    background-color: rgba(239, 68, 68, 0.2);
    color: #FCA5A5;
    border: 1px solid rgba(239, 68, 68, 0.3);
  }

  /* Action Buttons */
  .btn-action {
    background-color: rgba(255, 255, 255, 0.08);
    color: #E2E8F0;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 6px;
    padding: 4px 8px;
    font-size: 0.75rem;
    font-weight: 500;
    transition: all 0.15s ease;
  }

  .btn-action:hover {
    background-color: rgba(255, 255, 255, 0.18);
    color: #FFFFFF;
  }

  .btn-action-edit:hover {
    background-color: var(--color-blue);
    border-color: var(--color-blue);
    color: #FFFFFF;
  }

  .btn-action-delete:hover {
    background-color: #DC2626;
    border-color: #DC2626;
    color: #FFFFFF;
  }

  /* Pagination */
  .page-link {
    color: #94A3B8;
    background-color: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
    font-size: 0.85rem;
  }

  .page-item.active .page-link {
    background-color: var(--color-blue);
    border-color: var(--color-blue);
    color: #FFFFFF;
  }
</style>

<div class="container my-4">
  
  {{-- Header --}}
  <div class="dashboard-header d-flex align-items-center justify-content-between flex-wrap gap-3">
    <div>
      <div class="header-badge">
        <i class="bi bi-box-seam"></i> Inventaris
      </div>
      <h1 class="brand-title">Daftar Produk T-Shirt</h1>
      <p class="text-description m-0">Kelola data produk, harga jual, dan ketersediaan stok.</p>
    </div>
  </div>

  {{-- Main Card --}}
  <div class="luxury-card">
    <div class="row g-2 justify-content-between align-items-center mb-3">
      <div class="col-md-5 col-lg-4">
        @can('create', App\Models\Produk::class)
          <a href="{{ route('produk.create') }}" class="btn btn-create d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> Tambah Produk
          </a>
        @endcan
      </div>

      <div class="col-md-7 col-lg-5">
        <form action="{{ route('produk.index') }}" method="GET">
          <div class="input-group search-box">
            <input
              type="text"
              name="search"
              value="{{ request('search') }}"
              class="form-control"
              placeholder="Cari nama produk..."
            >
            <button class="btn btn-search" type="submit">
              <i class="bi bi-search me-1"></i> Cari
            </button>
          </div>
        </form>
      </div>
    </div>

    {{-- Tabel --}}
    <div class="table-responsive">
      <table class="table table-custom align-middle">
        <thead>
          <tr>
            <th scope="col" class="text-center" style="width: 40px;">#</th>
            <th scope="col" class="text-center" style="width: 70px;">Gambar</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Penginput</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Harga Jual</th>
            <th scope="col" class="text-center">Stok</th>
            <th scope="col" class="text-center" style="width: 180px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
          <tr>
            <td class="text-center text-white-50 font-number">{{ $products->firstItem() + $loop->index }}</td>
            <td>
              <div class="thumb-box">
                @if($product->foto)
                  <img src="{{ \Illuminate\Support\Facades\Storage::url($product->foto) }}" alt="Foto">
                @else
                  <i class="bi bi-image text-white-50 fs-5"></i>
                @endif
              </div>
            </td>
            <td class="fw-semibold text-white">{{ $product->nama }}</td>
            <td class="text-white-50 fs-7">
              <i class="bi bi-person me-1"></i>{{ $product->user->name ?? 'Sistem' }}
            </td>
            <td class="font-number text-white-50">Rp {{ number_format($product->harga_beli ?? 0, 0, ',', '.') }}</td>
            <td class="font-number fw-semibold text-white">Rp {{ number_format($product->harga_jual ?? 0, 0, ',', '.') }}</td>
            <td class="text-center">
              @if($product->stok > 5)
                <span class="badge-stock-safe font-number">
                  <i class="bi bi-check"></i> {{ $product->stok }} Pcs
                </span>
              @else
                <span class="badge-stock-low font-number">
                  <i class="bi bi-exclamation"></i> {{ $product->stok }} Pcs
                </span>
              @endif
            </td>
            <td>
              <div class="d-flex justify-content-center align-items-center gap-1">
                <a href="{{ route('produk.show', $product) }}" class="btn btn-action text-decoration-none" title="Detail">
                  <i class="bi bi-eye"></i> Detail
                </a>

                @can('update', $product)
                  <a href="{{ route('produk.edit', $product) }}" class="btn btn-action btn-action-edit text-decoration-none" title="Edit">
                    <i class="bi bi-pencil"></i> Edit
                  </a>
                @endcan

                @can('delete', $product)
                  <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-action btn-action-delete" onclick="return confirm('Hapus produk ini?')" title="Hapus">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </form>
                @endcan
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="text-white-50 text-center py-4">
              <i class="bi bi-inbox fs-3 d-block text-white-50 mb-1"></i>
              Data produk tidak ditemukan.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      {{ $products->withQueryString()->links() }}
    </div>
  </div>

</div>

@endsection