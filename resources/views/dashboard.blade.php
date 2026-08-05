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
  .dashboard-header {
    background: linear-gradient(135deg, #121212 0%, #2B2B2B 100%);
    border-radius: 16px;
    padding: 2.5rem;
    color: #FFFFFF;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    margin-bottom: 2.5rem;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.1);
  }

  .dashboard-header::after {
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

  .header-badge {
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
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
    color: var(--primary-black);
    margin: 2.5rem 0 1.25rem;
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Cinzel', serif;
    letter-spacing: 0.5px;
  }

  .section-title::after {
    content: '';
    flex-grow: 1;
    height: 1px;
    background: linear-gradient(to right, var(--border-color), transparent);
  }

  /* Cards Style */
  .summary-card {
    border: 1px solid var(--border-color);
    border-radius: 16px;
    background: var(--card-bg);
    padding: 1.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    height: 100%;
  }

  .summary-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    border-color: var(--primary-black);
  }

  .icon-box {
    width: 52px;
    height: 52px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    margin-bottom: 1rem;
  }

  .icon-dark { background: #121212; color: #FFFFFF; }
  .icon-gray { background: #E9ECEF; color: #212529; }
  .icon-outline { background: #FFFFFF; color: #121212; border: 1px solid #121212; }

  .stat-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--text-muted);
    font-weight: 600;
  }

  .stat-value {
    font-size: 1.65rem;
    font-weight: 700;
    color: var(--primary-black);
    margin-top: 0.25rem;
  }

  /* Tables Style */
  .luxury-table-card {
    background: var(--card-bg);
    border-radius: 16px;
    border: 1px solid var(--border-color);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    padding: 1.5rem;
    margin-bottom: 2rem;
  }

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
    padding: 14px 16px;
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

  /* Badges */
  .badge-stock-low {
    background-color: #212529;
    color: #FFFFFF;
    border: 1px solid #212529;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
  }

  .badge-stock-empty {
    background-color: #FFFFFF;
    color: #212529;
    border: 1px solid #212529;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
  }

  .badge-stock-safe {
    background-color: #E9ECEF;
    color: #212529;
    border: 1px solid #CED4DA;
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

  .rank-1 { background: #121212; color: #FFFFFF; }
  .rank-2 { background: #495057; color: #FFFFFF; }
  .rank-3 { background: #ADB5BD; color: #121212; }
  .rank-other { background: #E9ECEF; color: #495057; }

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

<div class="container my-5">

  <div class="dashboard-header">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <span class="header-badge d-inline-block mb-3">
          <i class="bi bi-calendar3 me-2"></i>{{ $tanggalHariIni->translatedFormat('l, d F Y') }}
        </span>
        <h2 class="serif-font fw-bold mb-2 display-6">Dashboard Overview</h2>
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
          <div class="icon-box icon-dark">
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
          <div class="stat-value">{{ number_format($ringkasan['total_transaksi']) }} <span class="fs-6 fw-normal text-muted">Pesanan</span></div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6">
        <div class="summary-card">
          <div class="icon-box icon-outline">
            <i class="bi bi-wallet2"></i>
          </div>
          <div class="stat-label">Pembayaran Tunai</div>
          <div class="stat-value">Rp {{ number_format($ringkasan['total_cash']) }}</div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6">
        <div class="summary-card">
          <div class="icon-box icon-dark">
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
          <h5 class="serif-font fw-bold text-dark m-0">
            <i class="bi bi-exclamation-circle me-2"></i>Stok Menipis
          </h5>
          <span class="badge bg-dark text-white rounded-pill px-3 py-2 fs-7 fw-normal">Perlu Restok</span>
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
                <td class="text-muted fs-7">{{ $produkStokRendah->firstItem() + $index }}</td>
                <td class="fw-semibold">
                  <div class="d-flex align-items-center">
                    <i class="bi bi-dash-lg me-2 text-muted"></i>
                    <span>{{ $produk->nama }}</span>
                  </div>
                </td>
                <td class="text-end">
                  <span class="badge-stock-low">{{ $produk->stok }} Pcs</span>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="text-center text-muted py-4">
                  <i class="bi bi-check2-circle fs-3 d-block text-dark mb-2"></i>
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
          <h5 class="serif-font fw-bold text-dark m-0">
            <i class="bi bi-x-circle me-2"></i>Stok Habis
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
                <td class="text-muted fs-7">{{ $produkStokHabis->firstItem() + $index }}</td>
                <td class="fw-semibold">
                  <div class="d-flex align-items-center">
                    <i class="bi bi-dash-lg me-2 text-muted"></i>
                    <span>{{ $produk->nama }}</span>
                  </div>
                </td>
                <td class="text-end">
                  <span class="badge-stock-empty">Kosong</span>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="text-center text-muted py-4">
                  <i class="bi bi-box2 fs-3 d-block text-muted mb-2"></i>
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
                  <div class="fw-bold text-dark fs-6">{{ $produk->nama }}</div>
                  <small class="text-muted">Signature T-Shirt Collection</small>
                </td>
                <td>
                  @if($produk->stok > 0)
                    <span class="badge-stock-safe">{{ $produk->stok }} Pcs</span>
                  @else
                    <span class="badge-stock-empty">Habis</span>
                  @endif
                </td>
                <td class="text-end">
                  <div class="fw-bold text-dark fs-6">{{ number_format($produk->total_terjual) }} <span class="fs-7 fw-normal text-muted">Pcs</span></div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center text-muted py-5">
                  <i class="bi bi-inbox fs-1 d-block text-muted mb-2"></i>
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

@endsection