@extends('layouts.app')

@section('title', 'Daftar Penjualan')

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
    position: relative;
    overflow: hidden;
  }

  .page-header::after {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(0,0,0,0) 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  .content-card {
    background: var(--card-bg);
    border-radius: 16px;
    border: 1px solid var(--border-gray);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    padding: 2rem;
  }

  /* Search Box */
  .search-box .form-control {
    border-radius: 10px 0 0 10px;
    border: 1px solid var(--border-gray);
    padding: 0.65rem 1.2rem;
    background-color: #ffffff;
    color: var(--dark-secondary);
  }

  .search-box .form-control:focus {
    box-shadow: none;
    border-color: var(--dark-primary);
  }

  .search-box .btn-search {
    background: var(--dark-primary);
    color: #ffffff;
    border-radius: 0 10px 10px 0;
    padding: 0.65rem 1.4rem;
    font-weight: 600;
    border: none;
    transition: all 0.2s ease;
  }

  .search-box .btn-search:hover {
    background: #343a40;
    color: #ffffff;
  }

  /* Buttons */
  .btn-create {
    background: var(--dark-primary);
    color: #ffffff;
    border: none;
    border-radius: 10px;
    padding: 0.7rem 1.4rem;
    font-weight: 600;
    transition: all 0.2s ease;
    text-decoration: none;
  }

  .btn-create:hover {
    background: #343a40;
    color: #ffffff;
  }

  /* Table Customization */
  .table-custom {
    margin-bottom: 0;
  }

  .table-custom thead th {
    background: var(--gray-light);
    border: none;
    color: var(--dark-secondary);
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 14px 16px;
    font-weight: 700;
  }

  .table-custom tbody td {
    padding: 16px;
    border-bottom: 1px solid var(--border-gray);
    color: var(--dark-secondary);
    font-size: 0.9rem;
  }

  .table-custom tbody tr:last-child td {
    border-bottom: none;
  }

  .table-custom tbody tr:hover {
    background-color: var(--gray-light);
  }

  /* Badges */
  .badge-payment {
    background-color: var(--gray-light);
    color: var(--dark-secondary);
    border: 1px solid var(--border-gray);
    padding: 6px 14px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 0.75rem;
  }

  .badge-status-success {
    background-color: #e6f4ea;
    color: #137333;
    border: 1px solid #ceead6;
    padding: 6px 14px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 0.75rem;
  }

  .badge-status-pending {
    background-color: #fef7e0;
    color: #b06000;
    border: 1px solid #feefc3;
    padding: 6px 14px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 0.75rem;
  }

  .badge-status-danger {
    background-color: #fce8e6;
    color: #c5221f;
    border: 1px solid #fad2cf;
    padding: 6px 14px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 0.75rem;
  }

  /* Action Buttons */
  .btn-action-detail {
    background-color: var(--gray-light);
    color: var(--dark-secondary);
    border: 1px solid var(--border-gray);
    border-radius: 8px;
    padding: 6px 12px;
    font-weight: 600;
    font-size: 0.825rem;
    transition: all 0.2s ease;
    text-decoration: none;
  }

  .btn-action-detail:hover {
    background-color: #e2e6ea;
    color: var(--dark-primary);
  }

  .btn-action-edit {
    background-color: #fef7e0;
    color: #b06000;
    border: 1px solid #feefc3;
    border-radius: 8px;
    padding: 6px 12px;
    font-weight: 600;
    font-size: 0.825rem;
    transition: all 0.2s ease;
    text-decoration: none;
  }

  .btn-action-edit:hover {
    background-color: #feefc3;
    color: #8a4b00;
  }

  .btn-action-delete {
    background-color: #fce8e6;
    color: #c5221f;
    border: 1px solid #fad2cf;
    border-radius: 8px;
    padding: 6px 12px;
    font-weight: 600;
    font-size: 0.825rem;
    transition: all 0.2s ease;
  }

  .btn-action-delete:hover {
    background-color: #fad2cf;
    color: #a51d19;
  }

  /* Pagination */
  .pagination {
    margin-bottom: 0;
  }

  .page-link {
    color: var(--dark-secondary);
    border-color: var(--border-gray);
  }

  .page-item.active .page-link {
    background-color: var(--dark-primary);
    border-color: var(--dark-primary);
    color: #ffffff;
  }
</style>

<div class="container my-4">
  @if(session('error') || session('errors'))
    <div class="alert alert-dark alert-dismissible fade show mb-4 d-flex align-items-center gap-2 rounded-3" role="alert">
      <i class="bi bi-exclamation-triangle-fill fs-5"></i>
      <div><strong>Perhatian:</strong> {{ session('error') ?? session('errors') }}</div>
      <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
      <h2 class="fw-bold m-0 fs-2">Penjualan</h2>
      <p class="text-white-50 m-0 mt-1">Pantau seluruh transaksi penjualan dan status pembayaran kasir</p>
    </div>
    <div class="d-none d-md-block">
      <i class="bi bi-receipt display-4 text-white" style="opacity: 0.2;"></i>
    </div>
  </div>

  <div class="content-card">
    <div class="row g-3 justify-content-between align-items-center mb-4">
      <div class="col-md-5 col-lg-4">
        <a href="{{ route('penjualan.create') }}" class="btn btn-create d-inline-flex align-items-center gap-2">
          <i class="bi bi-cart-plus-fill"></i> Transaksi Baru
        </a>
      </div>

      <div class="col-md-7 col-lg-5">
        <form action="{{ route('penjualan.index') }}" method="GET">
          <div class="input-group search-box">
            <input
              type="text"
              name="search"
              value="{{ request('search') }}"
              class="form-control"
              placeholder="Cari transaksi atau nama kasir..."
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
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col">Kasir</th>
            <th scope="col">Total Pembayaran</th>
            <th scope="col" class="text-center">Metode</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center" style="width: 22%;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($sales as $sale)
          <tr>
            <td class="text-muted fs-7">{{ $sales->firstItem() + $loop->index }}</td>
            <td class="fw-medium text-dark">
              <div class="d-flex align-items-center gap-1">
                <i class="bi bi-calendar3 me-1 text-muted"></i>
                <span>{{ $sale->created_at ? $sale->created_at->translatedFormat('d-m-Y H:i:s') : '-' }}</span>
              </div>
            </td>
            <td class="text-secondary">
              <div class="d-flex align-items-center gap-1">
                <i class="bi bi-person me-1 text-muted"></i>
                <span>{{ $sale->user->name ?? 'Sistem' }}</span>
              </div>
            </td>
            <td class="fw-bold fs-6 text-dark">
              Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}
            </td>
            <td class="text-center">
              <span class="badge-payment">
                <i class="bi bi-credit-card-2-front me-1"></i>{{ ucfirst($sale->metode_pembayaran ?? 'Tunai') }}
              </span>
            </td>
            <td class="text-center">
              @php
                $statusLower = strtolower($sale->status ?? '');
              @endphp
              @if($statusLower == 'lunas' || $statusLower == 'completed' || $statusLower == 'sukses')
                <span class="badge-status-success"><i class="bi bi-check-circle me-1"></i>{{ ucfirst($sale->status) }}</span>
              @elseif($statusLower == 'pending' || $statusLower == 'proses')
                <span class="badge-status-pending"><i class="bi bi-hourglass-split me-1"></i>{{ ucfirst($sale->status) }}</span>
              @else
                <span class="badge-status-danger"><i class="bi bi-x-circle me-1"></i>{{ ucfirst($sale->status ?? 'Gagal') }}</span>
              @endif
            </td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-1">
                <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-action-detail">
                  <i class="bi bi-eye me-1"></i> Detail
                </a>

                @can('update', $sale)
                  <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-action-edit">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                  </a>
                @endcan

                @can('delete', $sale)
                  <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-action-delete" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                      <i class="bi bi-trash3 me-1"></i> Hapus
                    </button>
                  </form>
                @endcan
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-muted text-center py-5">
              <i class="bi bi-receipt-cutoff fs-1 d-block text-muted mb-2"></i>
              <span class="fw-semibold">Data transaksi penjualan tidak ditemukan.</span>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $sales->withQueryString()->links() }}
    </div>
  </div>
</div>

@endsection