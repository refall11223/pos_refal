@extends('layouts.app')

@section('title', 'Daftar Produk T-Shirt')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  :root {
    --bg-main: #F8F9FA;
    --card-bg: #FFFFFF;
    --primary-black: #121212;
    --soft-black: #1E1E1E;
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
    padding: 2.5rem;
    color: #FFFFFF;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.1);
  }

  .page-header::after {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 220px;
    height: 220px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, rgba(0,0,0,0) 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  /* Card Container */
  .content-card {
    background: var(--card-bg);
    border-radius: 16px;
    border: 1px solid var(--border-color);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    padding: 2rem;
  }

  /* Search Box Styling */
  .search-box .form-control {
    border-radius: 10px 0 0 10px;
    border: 1px solid var(--border-color);
    padding: 0.7rem 1.2rem;
    background-color: #F8F9FA;
    color: var(--primary-black);
    font-size: 0.9rem;
  }

  .search-box .form-control:focus {
    box-shadow: none;
    border-color: var(--primary-black);
    background-color: #FFFFFF;
  }

  .search-box .btn-search {
    background-color: var(--primary-black);
    color: #FFFFFF;
    border-radius: 0 10px 10px 0;
    padding: 0.7rem 1.4rem;
    font-weight: 500;
    border: 1px solid var(--primary-black);
    transition: all 0.25s ease;
  }

  .search-box .btn-search:hover {
    background-color: var(--accent-gray);
    color: #FFFFFF;
  }

  /* Action Button Create + Animasi Klik */
  .btn-create {
    background-color: var(--primary-black);
    color: #FFFFFF;
    border: 1px solid var(--primary-black);
    border-radius: 10px;
    padding: 0.7rem 1.4rem;
    font-weight: 600;
    font-size: 0.9rem;
    letter-spacing: 0.3px;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    position: relative;
    overflow: hidden;
    user-select: none;
  }

  .btn-create:hover {
    background-color: #FFFFFF;
    color: var(--primary-black);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
    transform: translateY(-2px);
  }

  .btn-create:active {
    transform: scale(0.95) translateY(0);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  /* Efek Ripple */
  .ripple-effect {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
    transform: scale(0);
    animation: ripple-animation 0.6s linear;
    pointer-events: none;
  }

  @keyframes ripple-animation {
    to {
      transform: scale(4);
      opacity: 0;
    }
  }

  /* Product Thumbnail */
  .product-thumb {
    width: 55px;
    height: 55px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid var(--border-color);
    transition: transform 0.2s ease;
  }

  .product-thumb:hover {
    transform: scale(1.08);
  }

  .thumb-placeholder {
    width: 55px;
    height: 55px;
    background-color: #F1F3F5;
    border: 1px solid var(--border-color);
    border-radius: 10px;
    color: var(--text-muted);
  }

  /* Table Custom Styling */
  .table-custom {
    margin-bottom: 0;
  }

  .table-custom thead th {
    background: #F8F9FA;
    border-bottom: 2px solid var(--border-color);
    color: var(--primary-black);
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    padding: 16px;
    font-weight: 700;
  }

  .table-custom tbody td {
    padding: 16px;
    border-bottom: 1px solid var(--border-color);
    color: var(--primary-black);
    font-size: 0.9rem;
  }

  .table-custom tbody tr:last-child td {
    border-bottom: none;
  }

  .table-custom tbody tr:hover {
    background-color: var(--hover-bg);
  }

  /* Badges & Indicators */
  .badge-stock-safe {
    background-color: #E9ECEF;
    color: #212529;
    border: 1px solid #CED4DA;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
  }

  .badge-stock-low {
    background-color: #212529;
    color: #FFFFFF;
    border: 1px solid #212529;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
  }

  /* Action Buttons inside Table */
  .btn-action-detail {
    background-color: #FFFFFF;
    color: #495057;
    border: 1px solid #CED4DA;
    border-radius: 8px;
    padding: 6px 12px;
    font-weight: 600;
    font-size: 0.8rem;
    transition: all 0.2s ease;
    text-decoration: none;
  }

  .btn-action-detail:hover {
    background-color: #F8F9FA;
    color: var(--primary-black);
    border-color: var(--primary-black);
  }

  .btn-action-edit {
    background-color: var(--accent-gray);
    color: #FFFFFF;
    border: 1px solid var(--accent-gray);
    border-radius: 8px;
    padding: 6px 12px;
    font-weight: 600;
    font-size: 0.8rem;
    transition: all 0.2s ease;
    text-decoration: none;
  }

  .btn-action-edit:hover {
    background-color: var(--primary-black);
    color: #FFFFFF;
  }

  .btn-action-delete {
    background-color: #FFFFFF;
    color: #212529;
    border: 1px solid #212529;
    border-radius: 8px;
    padding: 6px 12px;
    font-weight: 600;
    font-size: 0.8rem;
    transition: all 0.2s ease;
  }

  .btn-action-delete:hover {
    background-color: #212529;
    color: #FFFFFF;
  }

  /* Pagination Styling */
  .pagination {
    margin-bottom: 0;
  }

  .page-link {
    color: var(--primary-black);
    border-color: var(--border-color);
  }

  .page-item.active .page-link {
    background-color: var(--primary-black);
    border-color: var(--primary-black);
    color: #FFFFFF;
  }

  .page-link:hover {
    color: var(--primary-black);
    background-color: var(--hover-bg);
  }
</style>
@endpush

@section('content')

@include('layouts.navbar')

<div class="container my-5">
  <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
      <h2 class="serif-font fw-bold m-0 fs-2">Koleksi T-Shirt</h2>
      <p class="text-white-50 m-0 mt-1" style="font-size: 0.95rem;">Kelola katalog t-shirt, pembaruan stok, dan penetapan harga jual</p>
    </div>
    <div class="d-none d-md-block">
      <i class="bi bi-tag display-4 text-white" style="opacity: 0.2;"></i>
    </div>
  </div>

  <div class="content-card">
    <div class="row g-3 justify-content-between align-items-center mb-4">
      <div class="col-md-5 col-lg-4">
        @can('create', App\Models\Produk::class)
          <a href="{{ route('produk.create') }}" class="btn btn-create d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> Tambah Produk Baru
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
              placeholder="Cari artikel t-shirt..."
            >
            <button class="btn btn-search" type="submit">
              <i class="bi bi-search me-1"></i> Cari
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-custom align-middle">
        <thead>
          <tr>
            <th scope="col" style="width: 5%;">#</th>
            <th scope="col" class="text-center" style="width: 10%;">Gambar</th>
            <th scope="col">Nama T-Shirt</th>
            <th scope="col">Penginput</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Harga Jual</th>
            <th scope="col" class="text-center">Stok</th>
            <th scope="col" class="text-center" style="width: 22%;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
          <tr>
            <td class="text-muted fs-7">{{ $products->firstItem() + $loop->index }}</td>
            <td class="text-center">
              @if($product->foto)
                <img src="{{ asset('storage/'.$product->foto) }}" class="product-thumb" alt="{{ $product->nama }}">
              @else
                <div class="thumb-placeholder d-flex align-items-center justify-content-center m-auto">
                  <i class="bi bi-bag fs-5"></i>
                </div>
              @endif
            </td>
            <td class="fw-bold">{{ $product->nama }}</td>
            <td class="text-secondary">
              <div class="d-flex align-items-center gap-1">
                <i class="bi bi-person me-1 text-muted"></i>
                <span>{{ $product->user->name ?? 'Sistem' }}</span>
              </div>
            </td>
            <td class="fw-semibold text-secondary">Rp {{ number_format($product->harga_beli ?? 0, 0, ',', '.') }}</td>
            <td class="fw-bold">Rp {{ number_format($product->harga_jual ?? 0, 0, ',', '.') }}</td>
            <td class="text-center">
              @if($product->stok > 5)
                <span class="badge-stock-safe"><i class="bi bi-check2 me-1"></i>{{ $product->stok }} Pcs</span>
              @else
                <span class="badge-stock-low"><i class="bi bi-exclamation-circle me-1"></i>{{ $product->stok }} Pcs</span>
              @endif
            </td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('produk.show', $product) }}" class="btn btn-action-detail">
                  <i class="bi bi-eye me-1"></i> Detail
                </a>

                @can('update', $product)
                  <a href="{{ route('produk.edit', $product) }}" class="btn btn-action-edit">
                    <i class="bi bi-pencil me-1"></i> Edit
                  </a>
                @endcan

                @can('delete', $product)
                  <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-action-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                      <i class="bi bi-trash me-1"></i> Hapus
                    </button>
                  </form>
                @endcan
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="text-muted text-center py-5">
              <i class="bi bi-inbox fs-1 d-block text-muted mb-2"></i>
              <span class="fw-semibold">Data produk t-shirt tidak ditemukan atau belum tersedia.</span>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $products->withQueryString()->links() }}
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-create').forEach(button => {
      button.addEventListener('click', function (e) {
        const circle = document.createElement('span');
        const diameter = Math.max(this.clientWidth, this.clientHeight);
        const radius = diameter / 2;

        const rect = this.getBoundingClientRect();
        circle.style.width = circle.style.height = `${diameter}px`;
        circle.style.left = `${e.clientX - rect.left - radius}px`;
        circle.style.top = `${e.clientY - rect.top - radius}px`;
        circle.classList.add('ripple-effect');

        const ripple = this.querySelector('.ripple-effect');
        if (ripple) {
          ripple.remove();
        }

        this.appendChild(circle);
      });
    });
  });
</script>

@endsection