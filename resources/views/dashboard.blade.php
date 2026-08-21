@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    /* Gradien dari pojok kiri atas (Biru) ke pojok kanan bawah (Hitam) */
    background: linear-gradient(135deg, #1E3A8A 0%, var(--color-black) 100%);
    color: #FFFFFF;
    min-height: 100vh;
  }

  .serif-font {
    font-family: 'Cinzel', serif;
    letter-spacing: 0.5px;
  }

  /* Ornamen Glow Kaca pada Background Container */
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
    padding: 2.5rem;
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
    width: 220px;
    height: 220px;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.25) 0%, rgba(0,0,0,0) 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  .header-badge {
    background: rgba(37, 99, 235, 0.25);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(37, 99, 235, 0.4);
    color: #FFFFFF;
    padding: 6px 16px;
    border-radius: 30px;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
  }

  /* Section Titles */
  .section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #FFFFFF;
    margin: 2.5rem 0 1.25rem;
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Cinzel', serif;
    letter-spacing: 0.5px;
  }

  .section-title i {
    color: var(--color-blue);
  }

  .section-title::after {
    content: '';
    flex-grow: 1;
    height: 1px;
    background: linear-gradient(to right, rgba(255, 255, 255, 0.15), transparent);
  }

  /* Cards Style (Glassmorphism) */
  .summary-card {
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 18px;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    padding: 1.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    height: 100%;
  }

  .summary-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(37, 99, 235, 0.25);
    border-color: rgba(37, 99, 235, 0.5);
    background: rgba(255, 255, 255, 0.08);
  }

  .icon-box {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
  }

  .icon-blue { background: rgba(37, 99, 235, 0.2); color: #60A5FA; border: 1px solid rgba(37, 99, 235, 0.4); }
  .icon-gray { background: rgba(148, 163, 184, 0.15); color: var(--color-gray); border: 1px solid rgba(148, 163, 184, 0.3); }
  .icon-dark { background: rgba(15, 23, 42, 0.6); color: #FFFFFF; border: 1px solid rgba(255, 255, 255, 0.1); }

  .stat-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--color-gray);
    font-weight: 600;
  }

  .stat-value {
    font-size: 1.65rem;
    font-weight: 700;
    color: #FFFFFF;
    margin-top: 0.25rem;
  }

  /* Tables Style (Glassmorphism + Fix Background Putih) */
  .luxury-table-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 18px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
    padding: 1.5rem;
    margin-bottom: 2rem;
  }

  /* OVERRIDE BOOTSTRAP TABLE BACKGROUND */
  .table-custom,
  .table-custom > :not(caption) > * > * {
    --bs-table-bg: transparent !important;
    --bs-table-color: #FFFFFF !important;
    background-color: transparent !important;
    color: #FFFFFF !important;
  }

  .table-custom {
    margin-bottom: 0;
  }

  .table-custom thead th {
    background: rgba(15, 23, 42, 0.5) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    color: var(--color-gray) !important;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    padding: 14px 16px;
    font-weight: 700;
  }

  .table-custom tbody tr {
    background-color: transparent !important;
  }

  .table-custom tbody td {
    padding: 16px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    color: #FFFFFF !important;
    font-size: 0.9rem;
    background-color: transparent !important;
  }

  .table-custom tbody tr:hover td {
    background-color: rgba(255, 255, 255, 0.06) !important;
  }

  /* Badges */
  .badge-stock-low {
    background-color: rgba(37, 99, 235, 0.2);
    color: #93C5FD;
    border: 1px solid rgba(37, 99, 235, 0.4);
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
  }

  .badge-stock-empty {
    background-color: rgba(239, 68, 68, 0.15);
    color: #FCA5A5;
    border: 1px solid rgba(239, 68, 68, 0.3);
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
  }

  .badge-stock-safe {
    background-color: rgba(148, 163, 184, 0.15);
    color: #E2E8F0;
    border: 1px solid rgba(148, 163, 184, 0.3);
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
  }

  .rank-badge {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.85rem;
  }

  .rank-1 { background: var(--color-blue); color: #FFFFFF; box-shadow: 0 0 12px rgba(37, 99, 235, 0.5); }
  .rank-2 { background: rgba(148, 163, 184, 0.3); color: #FFFFFF; border: 1px solid rgba(148, 163, 184, 0.4); }
  .rank-3 { background: rgba(15, 23, 42, 0.6); color: var(--color-gray); border: 1px solid rgba(255, 255, 255, 0.1); }
  .rank-other { background: rgba(255, 255, 255, 0.05); color: var(--color-gray); }

  /* Pagination Styling Glassmorphism */
  .pagination {
    margin-bottom: 0;
  }
  
  .page-link {
    color: var(--color-gray);
    background-color: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
  }
  
  .page-item.active .page-link {
    background-color: var(--color-blue);
    border-color: var(--color-blue);
    color: #FFFFFF;
    box-shadow: 0 0 10px rgba(37, 99, 235, 0.4);
  }

  .page-link:hover {
    color: #FFFFFF;
    background-color: rgba(37, 99, 235, 0.3);
    border-color: rgba(37, 99, 235, 0.4);
  }
</style>

<div class="dashboard-wrapper">
  <div class="container my-5">

    <div class="dashboard-header">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <span class="header-badge d-inline-block mb-3">
            <i class="bi bi-calendar3 me-2"></i>{{ $tanggalHariIni->translatedFormat('l, d F Y') }}
          </span>
          <h2 class="serif-font fw-bold mb-2 display-6">Beranda</h2>
          <p class="text-white-50 mb-0 fs-6">
            Ringkasan aktivitas penjualan, performa produk, dan manajemen stok t-shirt.
          </p>
        </div>
        <div class="col-lg-4 text-lg-end text-center d-none d-lg-block">
          <i class="bi bi-tag display-1 text-white" style="opacity: 0.15;"></i>
        </div>
      </div>
    </div>

    @can('viewAny', App\Models\User::class)
      <div class="section-title">
        <i class="bi bi-bar-chart-line"></i> Ringkasan Penjualan Hari Ini
      </div>

      <div class="row g-4 mb-3">
        <div class="col-xl-3 col-md-6">
          <div class="summary-card">
            <div class="icon-box icon-blue">
              <i class="bi bi-cash-stack"></i>
            </div>
            <div class="stat-label">Total Penjualan</div>
            <div class="stat-value">Rp {{ number_format($ringkasan['total_penjualan']) }}</div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6">
          <div class="summary-card">
            <div class="icon-box icon-gray">
              <i class="bi bi-bag-check"></i>
            </div>
            <div class="stat-label">Jumlah Transaksi</div>
            <div class="stat-value">{{ number_format($ringkasan['total_transaksi']) }} <span class="fs-6 fw-normal text-white-50">Pesanan</span></div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6">
          <div class="summary-card">
            <div class="icon-box icon-dark">
              <i class="bi bi-wallet2"></i>
            </div>
            <div class="stat-label">Pembayaran Tunai</div>
            <div class="stat-value">Rp {{ number_format($ringkasan['total_cash']) }}</div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6">
          <div class="summary-card">
            <div class="icon-box icon-blue">
              <i class="bi bi-credit-card-2-front"></i>
            </div>
            <div class="stat-label">Pembayaran Non-Tunai</div>
            <div class="stat-value">Rp {{ number_format($ringkasan['total_non_tunai']) }}</div>
          </div>
        </div>
      </div>
    @endcan

    <div class="section-title">
      <i class="bi bi-box-seam"></i> Status Persediaan T-Shirt
    </div>

    <div class="row g-4">
      <div class="col-lg-6">
        <div class="luxury-table-card">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="serif-font fw-bold text-white m-0">
              <i class="bi bi-exclamation-circle me-2 text-warning"></i>Stok Menipis
            </h5>
            <span class="badge bg-primary text-white rounded-pill px-3 py-2 fs-7 fw-normal">Perlu Restok</span>
          </div>

          <div class="table-responsive">
            <table class="table table-custom align-middle">
              <thead>
                <tr>
                  <th width="10%">#</th>
                  <th width="65%">Artikel T-Shirt</th>
                  <th width="25%" class="text-end">Sisa Stok</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($produkStokRendah as $index => $produk)
                <tr>
                  <td class="text-white-50 fs-7">{{ $produkStokRendah->firstItem() + $index }}</td>
                  <td class="fw-semibold">
                    <div class="d-flex align-items-center">
                      <i class="bi bi-dash-lg me-2 text-white-50"></i>
                      <span>{{ $produk->nama }}</span>
                    </div>
                  </td>
                  <td class="text-end">
                    <span class="badge-stock-low">{{ $produk->stok }} Pcs</span>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="3" class="text-center text-white-50 py-4">
                    <i class="bi bi-check2-circle fs-3 d-block text-white mb-2"></i>
                    Semua stok t-shirt dalam kondisi aman.
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-3">
            {{ $produkStokRendah->links() }}
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="luxury-table-card">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="serif-font fw-bold text-white m-0">
              <i class="bi bi-x-circle me-2 text-danger"></i>Stok Habis
            </h5>
            <span class="badge bg-secondary text-white rounded-pill px-3 py-2 fs-7 fw-normal">Kosong</span>
          </div>

          <div class="table-responsive">
            <table class="table table-custom align-middle">
              <thead>
                <tr>
                  <th width="10%">#</th>
                  <th width="65%">Artikel T-Shirt</th>
                  <th width="25%" class="text-end">Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($produkStokHabis as $index => $produk)
                <tr>
                  <td class="text-white-50 fs-7">{{ $produkStokHabis->firstItem() + $index }}</td>
                  <td class="fw-semibold">
                    <div class="d-flex align-items-center">
                      <i class="bi bi-dash-lg me-2 text-white-50"></i>
                      <span>{{ $produk->nama }}</span>
                    </div>
                  </td>
                  <td class="text-end">
                    <span class="badge-stock-empty">Kosong</span>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="3" class="text-center text-white-50 py-4">
                    <i class="bi bi-box2 fs-3 d-block text-white-50 mb-2"></i>
                    Tidak ada artikel t-shirt yang kehabisan stok saat ini.
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-3">
            {{ $produkStokHabis->links() }}
          </div>
        </div>
      </div>
    </div>

    <div class="section-title">
      <i class="bi bi-award"></i> T-Shirt Terlaris 
    </div>

    <div class="row">
      <div class="col-12">
        <div class="luxury-table-card">
          <div class="table-responsive">
            <table class="table table-custom align-middle">
              <thead>
                <tr>
                  <th width="10%" class="text-center">Peringkat</th>
                  <th width="50%">Nama Artikel T-Shirt</th>
                  <th width="20%">Sisa Stok Tersedia</th>
                  <th width="20%" class="text-end">Total Terjual</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($produkTerlaris as $index => $produk)
                <tr>
                  <td class="text-center">
                    @if($index == 0)
                      <span class="rank-badge rank-1"><i class="bi bi-trophy-fill"></i></span>
                    @elseif($index == 1)
                      <span class="rank-badge rank-2">2</span>
                    @elseif($index == 2)
                      <span class="rank-badge rank-3">3</span>
                    @else
                      <span class="rank-badge rank-other">{{ $index + 1 }}</span>
                    @endif
                  </td>
                  <td>
                    <div class="fw-bold text-white fs-6">{{ $produk->nama }}</div>
                    <small class="text-white-50">Signature T-Shirt Collection</small>
                  </td>
                  <td>
                    @if($produk->stok > 0)
                      <span class="badge-stock-safe">{{ $produk->stok }} Pcs</span>
                    @else
                      <span class="badge-stock-empty">Habis</span>
                    @endif
                  </td>
                  <td class="text-end">
                    <div class="fw-bold text-white fs-6">{{ number_format($produk->total_terjual) }} <span class="fs-7 fw-normal text-white-50">Pcs</span></div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="text-center text-white-50 py-5">
                    <i class="bi bi-inbox fs-1 d-block text-white-50 mb-2"></i>
                    Belum ada data transaksi penjualan t-shirt.
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection