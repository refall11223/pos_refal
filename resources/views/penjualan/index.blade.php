@extends('layouts.app')

@section('title', 'Daftar Riwayat Penjualan')

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

  .font-number {
    font-family: 'Roboto Mono', monospace;
    font-size: 0.85rem;
  }

  /* Badges */
  .badge-status-open {
    background-color: rgba(234, 179, 8, 0.2);
    color: #FDE047;
    border: 1px solid rgba(234, 179, 8, 0.4);
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 0.75rem;
  }

  .badge-status-completed {
    background-color: rgba(34, 197, 94, 0.2);
    color: #86EFAC;
    border: 1px solid rgba(34, 197, 94, 0.4);
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 0.75rem;
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
</style>

<div class="container my-4">

  {{-- Alert Message --}}
  @if (session('success'))
    <div class="alert alert-success bg-success text-white border-0 alert-dismissible fade show mb-3" role="alert">
      <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger bg-danger text-white border-0 alert-dismissible fade show mb-3" role="alert">
      <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Header --}}
  <div class="dashboard-header d-flex align-items-center justify-content-between flex-wrap gap-3">
    <div>
      <div class="header-badge">
        <i class="bi bi-receipt"></i> Penjualan
      </div>
      <h1 class="brand-title">Daftar Riwayat Penjualan</h1>
      <p class="text-description m-0">Kelola riwayat transaksi kasir dan transaksi aktif.</p>
    </div>
  </div>

  {{-- Main Card --}}
  <div class="luxury-card">
    <div class="row g-2 justify-content-between align-items-center mb-3">
      <div class="col-md-5 col-lg-4">
        <a href="{{ route('penjualan.create') }}" class="btn btn-create d-inline-flex align-items-center gap-2">
          <i class="bi bi-plus-lg"></i> Transaksi Baru 
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
              placeholder="Cari nama kasir..."
            >
            <button class="btn btn-search" type="submit">
              <i class="bi bi-search me-1"></i> Cari
            </button>
          </div>
        </form>
      </div>
    </div>

    {{-- Tabel Riwayat --}}
    <div class="table-responsive">
      <table class="table table-custom align-middle">
        <thead>
          <tr>
            <th scope="col" class="text-center" style="width: 40px;">#</th>
            <th scope="col">Kasir / Petugas</th>
            <th scope="col">Metode Pembayaran</th>
            <th scope="col">Total Pembayaran</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col" class="text-center" style="width: 180px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($sales as $sale)
          <tr>
            <td class="text-center text-white-50 font-number">{{ $sales->firstItem() + $loop->index }}</td>
            <td class="fw-semibold text-white">
              <i class="bi bi-person me-1 text-white-50"></i>{{ $sale->user->name ?? 'Sistem' }}
            </td>
            <td>
              <span class="badge bg-secondary font-number">{{ $sale->metode_pembayaran ?? 'CASH' }}</span>
            </td>
            <td class="font-number fw-semibold text-white">
              Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}
            </td>
            <td class="text-center">
              @if($sale->status === 'OPEN')
                <span class="badge-status-open font-number"><i class="bi bi-clock-history me-1"></i>OPEN</span>
              @else
                <span class="badge-status-completed font-number"><i class="bi bi-check2-circle me-1"></i>COMPLETED</span>
              @endif
            </td>
            <td class="text-white-50 font-number fs-7">
              {{ $sale->created_at ? $sale->created_at->format('d M Y, H:i') : '-' }}
            </td>
            <td>
              <div class="d-flex justify-content-center align-items-center gap-1">
                <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-action text-decoration-none" title="Detail">
                  <i class="bi bi-eye"></i> Detail
                </a>

                @if($sale->status === 'OPEN')
                  <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-action btn-action-edit text-decoration-none" title="Edit">
                    <i class="bi bi-pencil"></i> Edit
                  </a>

                  @can('delete', $sale)
                    <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-action btn-action-delete" onclick="return confirm('Batalkan transaksi ini?')" title="Batal">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  @endcan
                @endif
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-white-50 text-center py-4">
              <i class="bi bi-inbox fs-3 d-block text-white-50 mb-1"></i>
              Belum ada data riwayat penjualan.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      {{ $sales->withQueryString()->links() }}
    </div>
  </div>

</div>

@endsection