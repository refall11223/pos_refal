@extends('layouts.app')

@section('title', 'Tentang Kami - Refal T-Shirt')

@section('content')

@include('layouts.navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  :root {
    --color-blue: #2563EB;
    --color-black: #0F172A;
  }

  * {
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  body {
    background: linear-gradient(135deg, #1E3A8A 0%, var(--color-black) 100%);
    color: #FFFFFF;
    min-height: 100vh;
  }

  .serif-font {
    font-family: 'Cinzel', serif;
    letter-spacing: 2px;
  }

  .company-hero {
    background: rgba(255, 255, 255, 0.06);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 3rem 2rem;
    border: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
  }

  .company-logo-wrapper {
    background: rgba(37, 99, 235, 0.15);
    border: 2px solid rgba(37, 99, 235, 0.4);
    border-radius: 50%;
    width: 90px;
    height: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem auto;
    box-shadow: 0 0 25px rgba(37, 99, 235, 0.3);
  }

  /* Style Foto Lingkaran (Bunder) Sempurna */
  .hero-image-circle {
    width: 220px;
    height: 220px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid rgba(37, 99, 235, 0.5);
    box-shadow: 0 0 30px rgba(37, 99, 235, 0.4);
    transition: transform 0.3s ease;
  }

  .hero-image-circle:hover {
    transform: scale(1.05);
  }

  .info-card {
    background: rgba(255, 255, 255, 0.04);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    padding: 2.5rem;
  }

  .feature-box {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    padding: 1.5rem;
    height: 100%;
  }
</style>

<div class="container my-5">

  {{-- HERO SECTION --}}
  <div class="company-hero text-center mb-4">
    
    {{-- 1. ICON/LOGO --}}
    <div class="company-logo-wrapper">
      <i class="bi bi-tag-fill display-5 text-primary"></i>
    </div>

    {{-- 2. FOTO BUNDER DI TENGAH --}}
    <div class="my-4">
      <img src="https://images.unsplash.com/photo-1556905055-8f358a7a47b2?q=80&w=1000&auto=format&fit=crop" 
           alt="Refal T-Shirt Store" 
           class="hero-image-circle">
    </div>

    {{-- 3. NAMA PERUSAHAAN --}}
    <h1 class="serif-font fw-bold display-3 text-white mb-2">REFAL T-SHIRT</h1>
    <p class="text-white-50 fs-5 mb-0">Premium Apparel & Operational Management System</p>

  </div>

  {{-- DETAIL DESKRIPSI PERUSAHAAN --}}
  <div class="info-card">
    <div class="row justify-content-center text-center mb-4">
      <div class="col-lg-10">
        <h3 class="serif-font fw-bold text-white mb-3">TENTANG PERUSAHAAN</h3>
        <p class="text-white-50 fs-5 lh-lg mb-0">
          <strong>Refal T-Shirt</strong> adalah penyedia pakaian kasual dan kaos berkualitas premium yang berfokus pada kenyamanan, kualitas bahan, serta tren desain modern. Sistem kasir dan manajemen ini dibangun khusus untuk menunjang seluruh operasional bisnis Refal T-Shirt—mulai dari tata kelola stok produk, pemrosesan transaksi penjualan harian, hingga rekapitulasi data secara terstruktur dan efisien.
        </p>
      </div>
    </div>

    <hr class="border-secondary opacity-25 my-5">

    {{-- FITUR / PILAR UTAMA --}}
    <div class="row g-4 text-center">
      <div class="col-md-4">
        <div class="feature-box">
          <i class="bi bi-box-seam text-primary display-5 d-block mb-3"></i>
          <h5 class="fw-bold text-white mb-2">Manajemen Stok</h5>
          <p class="text-white-50 small m-0">Pengelolaan barang dan katalog kaos terkini secara tepat waktu.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="feature-box">
          <i class="bi bi-cart-check text-primary display-5 d-block mb-3"></i>
          <h5 class="fw-bold text-white mb-2">Kasir & Transaksi</h5>
          <p class="text-white-50 small m-0">Proses pencatatan transaksi yang praktis, cepat, dan akurat.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="feature-box">
          <i class="bi bi-bar-chart-line text-primary display-5 d-block mb-3"></i>
          <h5 class="fw-bold text-white mb-2">Rekapitulasi Data</h5>
          <p class="text-white-50 small m-0">Pemantauan riwayat penjualan untuk mendukung perkembangan bisnis.</p>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection