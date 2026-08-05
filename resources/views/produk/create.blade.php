@extends('layouts.app')

@section('title', 'Tambah Produk T-Shirt')

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
  .form-card {
    background: var(--card-bg);
    border-radius: 16px;
    border: 1px solid var(--border-color);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    padding: 2.5rem;
    max-width: 900px;
    margin: 0 auto;
  }

  /* Input Styling Overrides */
  .form-label {
    color: var(--primary-black);
    font-weight: 600;
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .form-control,
  .form-select,
  textarea {
    border: 1px solid var(--border-color) !important;
    border-radius: 10px !important;
    background-color: #F8F9FA !important;
    color: var(--primary-black) !important;
    font-size: 0.9rem !important;
    padding: 0.75rem 1rem !important;
    transition: all 0.25s ease !important;
  }

  .form-control:focus,
  .form-select:focus,
  textarea:focus {
    background-color: #FFFFFF !important;
    border-color: var(--primary-black) !important;
    box-shadow: 0 0 0 0.25rem rgba(18, 18, 18, 0.1) !important;
  }

  /* File Input Styling */
  input[type=file] {
    border: 1px dashed #CED4DA !important;
    background-color: #F8F9FA !important;
    padding: 12px !important;
  }

  input[type=file]::file-selector-button {
    background-color: var(--primary-black) !important;
    color: #FFFFFF !important;
    border: none !important;
    padding: 8px 16px !important;
    border-radius: 6px !important;
    font-weight: 600 !important;
    font-size: 0.85rem !important;
    margin-right: 15px !important;
    transition: all 0.2s ease !important;
  }

  input[type=file]::file-selector-button:hover {
    background-color: var(--accent-gray) !important;
  }

  /* Button Styling */
  .btn-save {
    background-color: var(--primary-black);
    color: #FFFFFF;
    border: 1px solid var(--primary-black);
    border-radius: 10px;
    padding: 0.7rem 1.8rem;
    font-weight: 600;
    font-size: 0.9rem;
    letter-spacing: 0.3px;
    transition: all 0.25s ease;
  }

  .btn-save:hover {
    background-color: var(--accent-gray);
    border-color: var(--accent-gray);
    color: #FFFFFF;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .btn-back {
    background-color: #FFFFFF;
    border: 1px solid #CED4DA;
    color: #495057;
    border-radius: 10px;
    padding: 0.7rem 1.6rem;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.25s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .btn-back:hover {
    background-color: #F8F9FA;
    border-color: var(--primary-black);
    color: var(--primary-black);
  }

  .border-top-custom {
    border-top: 1px solid var(--border-color);
  }
</style>
@endpush

@section('content')

@include('layouts.navbar')

<div class="container my-5">

  <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
      <h2 class="serif-font fw-bold m-0 fs-2">Tambah Produk Baru</h2>
      <p class="text-white-50 m-0 mt-1" style="font-size: 0.95rem;">
        Masukkan detail artikel t-shirt, penentuan harga, jumlah stok, dan unggah foto katalog
      </p>
    </div>
    <div>
      <a href="{{ route('produk.index') }}" class="btn btn-back">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
    </div>
  </div>

  <div class="form-card">
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      @include('Produk._form')

      <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top-custom">
        <a href="{{ route('produk.index') }}" class="btn btn-back">
          Batal
        </a>
        <button type="submit" class="btn btn-save">
          <i class="bi bi-check-lg me-1"></i> Simpan Produk
        </button>
      </div>
    </form>
  </div>

</div>

@endsection