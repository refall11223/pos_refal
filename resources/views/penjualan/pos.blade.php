@extends('layouts.app')

@section('title', 'Point of Sale (POS)')

@section('content')

@include('layouts.navbar')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --color-blue: #2563EB;
        --color-blue-glow: rgba(37, 99, 235, 0.4);
        --color-black: #0F172A;
        --color-gray: #94A3B8;
    }

    /* ================= GLOBAL ================= */
    html, body {
        background: #0F172A !important;
        background: linear-gradient(135deg, #1E3A8A 0%, #0F172A 100%) !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #FFFFFF !important;
        min-height: 100vh;
    }

    /* Ornamen Glow Background */
    .pos-wrapper {
        position: relative;
        overflow: hidden;
        min-height: calc(100vh - 80px);
        padding-bottom: 3rem;
    }

    .pos-wrapper::before {
        content: '';
        position: absolute;
        top: -150px;
        left: -150px;
        width: 500px;
        height: 500px;
        background: var(--color-blue-glow);
        filter: blur(140px);
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
    }

    .container-fluid {
        position: relative;
        z-index: 1;
    }

    /* ================= HEADER ================= */
    .page-header {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 22px 28px;
        color: #FFFFFF;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        margin-bottom: 25px;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .page-header h2 {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 4px;
        letter-spacing: 0.5px;
    }

    .page-header p {
        font-size: 14px;
        margin: 0;
        color: var(--color-gray);
    }

    .status-box {
        background: rgba(15, 23, 42, 0.6);
        color: #FFFFFF;
        padding: 8px 18px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 13px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* ================= CARD ================= */
    .pos-card {
        background: rgba(30, 41, 59, 0.6) !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    }

    .pos-card-header {
        background: rgba(255, 255, 255, 0.03);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding: 18px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .pos-card-header span {
        font-size: 18px;
        font-weight: 700;
        color: #FFFFFF;
    }

    .pos-card-header small {
        color: var(--color-gray);
        font-weight: 500;
        font-size: 12px;
    }

    /* ================= SEARCH ================= */
    .pos-search {
        height: 48px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        background-color: rgba(15, 23, 42, 0.5) !important;
        color: #FFFFFF !important;
        font-size: 14px;
        padding-left: 20px;
        transition: all 0.3s ease;
    }

    .pos-search::placeholder {
        color: #64748B !important;
    }

    .pos-search:focus {
        border-color: var(--color-blue) !important;
        box-shadow: 0 0 15px var(--color-blue-glow) !important;
        background-color: rgba(15, 23, 42, 0.8) !important;
    }

    /* ================= PRODUCT CARD ================= */
    .product-item-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 14px;
        padding: 12px;
        transition: all 0.3s ease;
        margin-bottom: 8px;
    }

    .product-item-card:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(147, 197, 253, 0.4);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }

    /* ================= FOTO PRODUK ================= */
    .product-thumb-pos {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .product-thumb-placeholder {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        background: rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    /* ================= NAMA PRODUK ================= */
    .product-name {
        font-size: 15px;
        font-weight: 700;
        color: #FFFFFF;
        margin-bottom: 4px;
    }

    /* ================= HARGA ================= */
    .price-tag {
        display: inline-block;
        background: rgba(37, 99, 235, 0.2);
        color: #93C5FD;
        border: 1px solid rgba(37, 99, 235, 0.3);
        padding: 3px 10px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
    }

    /* ================= QUANTITY ================= */
    .qty-input-pos {
        width: 65px;
        height: 40px;
        border-radius: 10px !important;
        text-align: center;
        font-size: 14px !important;
        font-weight: 700 !important;
        background: rgba(15, 23, 42, 0.6) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        color: #FFFFFF !important;
    }
    
    .qty-input-pos:focus {
        border-color: var(--color-blue) !important;
        box-shadow: 0 0 10px var(--color-blue-glow) !important;
    }

    /* ================= BUTTON TAMBAH ================= */
    .btn-add-pos {
        height: 40px;
        min-width: 44px;
        border: none;
        border-radius: 10px;
        background: var(--color-blue);
        color: #ffffff;
        font-size: 16px;
        font-weight: 700;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-add-pos:hover {
        background: #1D4ED8;
        transform: scale(1.05);
        box-shadow: 0 0 15px var(--color-blue-glow);
    }

    /* ================= CART ================= */
    .cart-table th {
        font-size: 12px;
        font-weight: 700;
        color: var(--color-gray);
        text-transform: uppercase;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        background: transparent !important;
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .cart-table td {
        vertical-align: middle;
        font-size: 13px;
        color: #FFFFFF;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        background: transparent !important;
    }

    /* ================= TOTAL ================= */
    .payment-section {
        background: rgba(15, 23, 42, 0.4);
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        padding: 20px;
    }

    .total-display-card {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.2), rgba(15, 23, 42, 0.8));
        border: 1px solid rgba(37, 99, 235, 0.3);
        border-radius: 14px;
        padding: 20px;
        color: #FFFFFF;
        text-align: center;
        box-shadow: inset 0 0 20px rgba(37, 99, 235, 0.1);
    }

    .total-display-card small {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #93C5FD;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .total-display-card h3 {
        font-size: 34px;
        font-weight: 800;
        margin-top: 5px;
        margin-bottom: 0;
        color: #FFFFFF;
        text-shadow: 0 0 15px rgba(255,255,255,0.3);
    }

    /* ================= FORM INPUTS & CHECKOUT ================= */
    .form-select {
        background-color: rgba(15, 23, 42, 0.6) !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        color: #FFFFFF !important;
        border-radius: 12px !important;
        height: 45px;
    }
    
    .form-select option {
        background-color: var(--color-black);
        color: #FFFFFF;
    }

    .btn-checkout {
        height: 50px;
        border: none;
        border-radius: 12px;
        background: #10B981; /* Emerald Green */
        color: #ffffff;
        font-size: 16px;
        font-weight: 700;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-checkout:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }

    .btn-cancel-pos {
        height: 45px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        border: 1px solid rgba(239, 68, 68, 0.5);
        color: #FCA5A5;
        background: rgba(239, 68, 68, 0.1);
        transition: all 0.3s;
    }
    
    .btn-cancel-pos:hover {
        background: rgba(239, 68, 68, 0.2);
        color: #FFFFFF;
    }

    /* Scrollbar Styling */
    ::-webkit-scrollbar {
        width: 6px;
    }
    ::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.02);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.25);
    }
</style>

<div class="pos-wrapper">
    <div class="container-fluid px-4 pt-4 pb-5">

        {{-- NOTIFIKASI ERROR (Aman untuk Object maupun String) --}}
        @if(isset($errors) && is_object($errors) && $errors->any())
            <div class="alert alert-danger mb-4" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #FCA5A5; border-radius: 12px;">
                <ul class="mb-0 px-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif(session('errors') && is_string(session('errors')))
            <div class="alert alert-danger mb-4" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #FCA5A5; border-radius: 12px;">
                {{ session('errors') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger mb-4" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #FCA5A5; border-radius: 12px;">
                {{ session('error') }}
            </div>
        @endif

        {{-- NOTIFIKASI SUKSES --}}
        @if(session('success'))
            <div class="alert alert-success mb-4" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #6EE7B7; border-radius: 12px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- ================= HEADER ================= --}}
        <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2>🖥️ {{ (isset($mode) && $mode == 'edit') ? 'Edit Penjualan' : 'Kasir / Point of Sale' }}</h2>
                <p>Pilih produk dan selesaikan transaksi kasir dengan antarmuka yang modern.</p>
            </div>

            <div class="status-box shadow-sm">
                Status Transaksi :
                <span class="{{ ($sale->status ?? '') == 'COMPLETED' ? 'text-success' : 'text-warning' }} ms-1">
                    {{ $sale->status ?? 'OPEN' }}
                </span>
            </div>
        </div>

        {{-- ================= CONTENT ================= --}}
        <div class="row g-4">

            {{-- ================= KATALOG PRODUK ================= --}}
            <div class="col-lg-7">
                <div class="pos-card h-100">

                    <div class="pos-card-header">
                        <span>🛍️ Katalog Produk</span>
                        <small>Pilih item untuk ditambahkan</small>
                    </div>

                    <div class="card-body p-4">

                        {{-- SEARCH FORM --}}
                        <form method="GET" action="{{ route('penjualan.create') }}" class="mb-4">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control pos-search"
                                placeholder="🔍 Ketik nama produk lalu tekan Enter..."
                            >
                        </form>

                        {{-- LIST PRODUK --}}
                        <div style="max-height: 580px; overflow-y: auto; padding-right: 8px;">
                            <div class="row g-2">
                                @forelse($products as $product)
                                    <div class="col-12">
                                        <form action="{{ route('itempenjualan.store') }}" method="POST" class="product-item-card">
                                            @csrf
                                            <input type="hidden" name="produk_id" value="{{ $product->id }}">
                                            @if(isset($sale->id))
                                                <input type="hidden" name="penjualan_id" value="{{ $sale->id }}">
                                            @endif

                                            <div class="row align-items-center g-3">
                                                {{-- FOTO --}}
                                                <div class="col-auto">
                                                    @if($product->foto)
                                                        <img src="{{ asset('storage/'.$product->foto) }}" class="product-thumb-pos" alt="{{ $product->nama }}">
                                                    @else
                                                        <div class="product-thumb-placeholder">📦</div>
                                                    @endif
                                                </div>

                                                {{-- DETAIL PRODUK --}}
                                                <div class="col">
                                                    <div class="product-name">{{ $product->nama }}</div>
                                                    <div>
                                                        <span class="price-tag">
                                                            Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                                        </span>
                                                    </div>
                                                </div>

                                                {{-- INPUT QUANTITY --}}
                                                <div class="col-auto">
                                                    <input
                                                        type="number"
                                                        name="kuantitas"
                                                        value="1"
                                                        min="1"
                                                        class="form-control qty-input-pos"
                                                        {{ ($sale->status ?? '') == 'COMPLETED' ? 'disabled' : '' }}>
                                                </div>

                                                {{-- SUBMIT BUTTON + --}}
                                                <div class="col-auto">
                                                    <button
                                                        type="submit"
                                                        class="btn btn-add-pos d-flex align-items-center justify-content-center"
                                                        {{ ($sale->status ?? '') == 'COMPLETED' ? 'disabled' : '' }}>
                                                        <i class="bi bi-plus-lg"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <div style="font-size: 3rem; color: rgba(255,255,255,0.2); margin-bottom: 15px;">🔍</div>
                                        <h5 style="color: var(--color-gray)">Produk tidak ditemukan</h5>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ================= KERANJANG ================= --}}
            <div class="col-lg-5">
                <div class="pos-card h-100 d-flex flex-column justify-content-between">

                    <div>
                        <div class="pos-card-header">
                            <span>🛒 Keranjang Belanja</span>
                            <span class="badge" style="background: rgba(37,99,235,0.3); border: 1px solid rgba(37,99,235,0.5); color: #93C5FD; padding: 6px 12px; border-radius: 8px;">
                                {{ count($sale->itempenjualan ?? []) }} Item
                            </span>
                        </div>

                        {{-- TABEL ITEM --}}
                        <div class="table-responsive px-3 py-2" style="max-height: 420px; overflow-y: auto;">
                            <table class="table cart-table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th width="85">Qty</th>
                                        <th class="text-end">Subtotal</th>
                                        <th width="50"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sale->itempenjualan ?? [] as $item)
                                        <tr>
                                            <td>
                                                <div class="fw-bold">{{ $item->produk->nama ?? 'Produk Dihapus' }}</div>
                                                <small style="color: var(--color-gray)">
                                                    Rp {{ number_format($item->produk->harga_jual ?? $item->harga_satuan, 0, ',', '.') }}
                                                </small>
                                            </td>

                                            <td>
                                                <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input
                                                        type="number"
                                                        name="kuantitas"
                                                        value="{{ $item->kuantitas }}"
                                                        min="1"
                                                        class="form-control qty-input-pos"
                                                        style="width: 70px; height: 35px;"
                                                        onchange="this.form.submit()"
                                                        {{ ($sale->status ?? '') == 'COMPLETED' ? 'disabled' : '' }}>
                                                </form>
                                            </td>

                                            <td class="text-end fw-bold" style="color: #93C5FD;">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </td>

                                            <td class="text-center">
                                                @can('delete', $item)
                                                    <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-outline-danger border-0 p-2 d-flex align-items-center justify-content-center" type="submit" style="border-radius: 8px;">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <div style="font-size: 45px; opacity: 0.3; margin-bottom: 10px;">🛒</div>
                                                <p style="color: var(--color-gray); font-size: 15px;">Keranjang Anda masih kosong</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- ================= FORM PEMBAYARAN ================= --}}
                    <div class="payment-section">

                        <div class="total-display-card">
                            <small>Total Tagihan</small>
                            <h3>Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}</h3>
                        </div>

                        @if(isset($sale->id))
                            <form
                                method="POST"
                                action="{{ route('penjualan.update', $sale->id) }}"
                                onsubmit="return confirm('Selesaikan transaksi?')"
                                class="mt-4">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-white-50 mb-2">METODE PEMBAYARAN</label>
                                    <select
                                        name="payment_method"
                                        class="form-select"
                                        required
                                        {{ ($sale->status ?? '') == 'COMPLETED' ? 'disabled' : '' }}>
                                        <option value="">-- Pilih Metode --</option>
                                        <option value="CASH">💵 Tunai (Cash)</option>
                                        <option value="QRIS">📱 Non Tunai (QRIS)</option>
                                    </select>
                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-checkout w-100 d-flex align-items-center justify-content-center gap-2 {{ ($sale->status ?? '') == 'COMPLETED' ? 'disabled' : '' }}">
                                    <i class="bi bi-check-circle-fill"></i> Checkout & Selesaikan
                                </button>
                            </form>

                            @can('delete', $sale)
                                <form
                                    action="{{ route('penjualan.destroy', $sale->id) }}"
                                    method="POST"
                                    class="mt-3"
                                    onsubmit="return confirm('Batalkan seluruh transaksi ini secara permanen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-cancel-pos w-100 d-flex align-items-center justify-content-center gap-2">
                                        <i class="bi bi-x-circle"></i> Batal & Hapus Transaksi
                                    </button>
                                </form>
                            @endcan
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection