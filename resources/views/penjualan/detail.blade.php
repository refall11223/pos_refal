@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

body{
    background:#f4f7fc;
    font-family:'Plus Jakarta Sans',sans-serif;
    color:#334155;
}

/* HEADER */
.page-header{
    background:linear-gradient(135deg,#ff6ea8,#8b5cf6);
    border-radius:25px;
    padding:30px 35px;
    color:#fff;
    box-shadow:0 18px 35px rgba(139,92,246,.25);
    margin-bottom:30px;
}

.page-header h2{
    font-weight:800;
    font-size:38px;
}

.page-header p{
    margin-top:6px;
    opacity:.9;
    font-size:18px;
}

/* CARD */

.content-card{
    background:#fff;
    border-radius:22px;
    border:none;
    box-shadow:0 15px 35px rgba(0,0,0,.06);
    padding:30px;
    margin-bottom:30px;
}

/* SUMMARY */

.summary-card{
    background:#f8fafc;
    border-radius:18px;
    padding:25px;
}

.summary-item{
    text-align:center;
}

.summary-icon{
    width:65px;
    height:65px;
    border-radius:50%;
    background:linear-gradient(135deg,#6366f1,#8b5cf6);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    font-size:28px;
    margin-bottom:15px;
}

.summary-label{
    display:block;
    color:#64748b;
    font-size:14px;
    font-weight:700;
    text-transform:uppercase;
}

.summary-value{
    font-size:22px;
    font-weight:800;
    margin-top:5px;
}

.total-price{
    color:#10b981;
}

/* TABLE */

.table-custom{
    border-collapse:separate;
    border-spacing:0 12px;
}

.table-custom thead th{
    border:none;
    background:#eef2ff;
    color:#4338ca;
    font-size:14px;
    text-transform:uppercase;
    padding:18px;
}

.table-custom tbody tr{
    background:white;
    box-shadow:0 6px 15px rgba(0,0,0,.05);
}

.table-custom tbody td{
    padding:18px;
    vertical-align:middle;
}

/* FOTO */

.product-thumb{
    width:65px;
    height:65px;
    border-radius:14px;
    object-fit:cover;
}

/* BUTTON */

.btn-back{
    background:white;
    color:#6366f1;
    border-radius:12px;
    padding:10px 24px;
    border:none;
    font-weight:700;
    text-decoration:none;
}

.btn-back:hover{
    background:#eef2ff;
    color:#4338ca;
}
</style>

<div class="container my-4">

<div class="page-header d-flex justify-content-between align-items-center">

<div>

<h2>🧾 Detail Penjualan</h2>

<p>
Informasi lengkap transaksi penjualan produk bouquet.
</p>

</div>

<a href="{{ route('penjualan.index') }}" class="btn btn-back">

← Kembali

</a>

</div>
<div class="content-card">

    <div class="d-flex align-items-center mb-4">
        <div class="summary-icon me-3">
            📋
        </div>

        <div>
            <h4 class="fw-bold mb-1">Ringkasan Transaksi</h4>
            <p class="text-muted mb-0">
                Informasi utama transaksi penjualan.
            </p>
        </div>
    </div>

    <div class="summary-card">

        <div class="row g-4">

            {{-- Kasir --}}
            <div class="col-md-4">

                <div class="summary-item">

                    <div class="summary-icon">
                        👤
                    </div>

                    <span class="summary-label">
                        Kasir
                    </span>

                    <div class="summary-value">
                        {{ $sale->user->name ?? 'Sistem' }}
                    </div>

                </div>

            </div>

            {{-- Tanggal --}}
            <div class="col-md-4">

                <div class="summary-item">

                    <div class="summary-icon">
                        📅
                    </div>

                    <span class="summary-label">
                        Tanggal
                    </span>

                    <div class="summary-value">

                        {{ $sale->created_at->translatedFormat('d F Y') }}

                        <br>

                        <small class="text-muted fw-semibold">

                            {{ $sale->created_at->format('H:i') }} WIB

                        </small>

                    </div>

                </div>

            </div>

            {{-- Total --}}
            <div class="col-md-4">

                <div class="summary-item">

                    <div class="summary-icon">
                        💰
                    </div>

                    <span class="summary-label">
                        Total Pembayaran
                    </span>

                    <div class="summary-value total-price">

                        Rp {{ number_format($sale->total_pembayaran,0,',','.') }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="content-card">

    <div class="d-flex align-items-center mb-4">

        <div class="summary-icon me-3">
            🛍️
        </div>

        <div>

            <h4 class="fw-bold mb-1">
                Daftar Produk
            </h4>

            <p class="text-muted mb-0">

                Produk yang terdapat pada transaksi ini.

            </p>

        </div>

    </div>

    <div class="table-responsive">

        <table class="table table-custom align-middle">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Foto</th>

                    <th>Nama Produk</th>

                    <th class="text-center">Qty</th>

                    <th class="text-end">Harga</th>

                    <th class="text-end">Subtotal</th>

                </tr>

            </thead>

            <tbody>
              @forelse($sale->itempenjualan as $index => $item)

<tr>

    <td class="fw-bold text-secondary">

        {{ $index + 1 }}

    </td>

    <td>

        @if($item->produk && $item->produk->foto)

            <img
                src="{{ asset('storage/'.$item->produk->foto) }}"
                class="product-thumb"
                alt="{{ $item->produk->nama }}">

        @else

            <div
                class="d-flex align-items-center justify-content-center bg-light rounded"
                style="width:65px;height:65px;font-size:28px;">

                📦

            </div>

        @endif

    </td>

    <td>

        <div class="fw-bold fs-5">

            {{ $item->produk->nama ?? 'Produk Dihapus' }}

        </div>

        <small class="text-muted">

            ID Produk :
            {{ $item->produk->id ?? '-' }}

        </small>

    </td>

    <td class="text-center">

        <span class="badge bg-primary px-3 py-2 rounded-pill fs-6">

            {{ $item->kuantitas }}

        </span>

    </td>

    <td class="text-end fw-semibold">

        Rp {{ number_format($item->produk->harga_jual ?? 0,0,',','.') }}

    </td>

    <td class="text-end">

        <span class="fw-bold text-success fs-5">

            Rp {{ number_format($item->subtotal,0,',','.') }}

        </span>

    </td>

</tr>

@empty

<tr>

    <td colspan="6" class="text-center py-5">

        <div style="font-size:60px">

            📦

        </div>

        <h5 class="mt-3 text-secondary">

            Tidak ada produk dalam transaksi ini

        </h5>

        <p class="text-muted mb-0">

            Produk akan muncul setelah transaksi memiliki item.

        </p>

    </td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>
</div>

<div class="content-card">

    <div class="row align-items-center">

        <div class="col-md-8">

            <div class="d-flex align-items-center">

                <div class="summary-icon me-3">
                    ✅
                </div>

                <div>

                    <h5 class="fw-bold mb-1">
                        Transaksi Berhasil
                    </h5>

                    <p class="text-muted mb-0">
                        Terima kasih telah menggunakan Bouquet Point of Sale.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4 text-md-end mt-3 mt-md-0">

            <a href="{{ route('penjualan.index') }}" class="btn btn-back">

                ← Kembali ke Daftar Penjualan

            </a>

        </div>

    </div>

</div>

</div>

@endsection