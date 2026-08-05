@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

@include('layouts.navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  :root {
    --bg-main: #F8F9FA;
    --card-bg: #FFFFFF;
    --primary-black: #121212;
    --soft-black: #2B2B2B;
    --accent-gray: #343A40;
    --text-muted: #6C757D;
    --border-color: #E9ECEF;
    --hover-bg: #E9ECEF;
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
    padding: 2.2rem 2.5rem;
    color: #FFFFFF;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    margin-bottom: 2.5rem;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.1);
  }

  .page-header::after {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, rgba(0,0,0,0) 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  /* Form Card Container */
  .form-card {
    background: var(--card-bg);
    border-radius: 16px;
    border: 1px solid var(--border-color);
    padding: 2.5rem;
    max-width: 900px;
    margin: auto;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
  }

  /* Styling Form Inputs & Selects */
  .form-label {
    color: var(--primary-black);
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
  }

  .form-control,
  .form-select,
  textarea {
    border: 1px solid #CED4DA !important;
    border-radius: 10px !important;
    background-color: #FFFFFF !important;
    color: var(--primary-black) !important;
    padding: 0.75rem 1rem !important;
    transition: all 0.2s ease-in-out !important;
    font-size: 0.95rem !important;
  }

  .form-control,
  .form-select {
    height: 48px;
  }

  textarea {
    min-height: 120px;
    resize: vertical;
  }

  .form-control:focus,
  .form-select:focus,
  textarea:focus {
    background-color: #FFFFFF !important;
    border-color: var(--primary-black) !important;
    box-shadow: 0 0 0 0.25rem rgba(18, 18, 18, 0.12) !important;
  }

  /* Custom Input File Styling */
  input[type=file].form-control {
    height: auto !important;
    padding: 0.5rem !important;
    background-color: var(--bg-main) !important;
  }

  input[type=file]::file-selector-button {
    background-color: var(--primary-black);
    color: #FFFFFF;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    margin-right: 1rem;
    transition: background-color 0.2s ease;
  }

  input[type=file]::file-selector-button:hover {
    background-color: var(--accent-gray);
  }

  /* Solid Monochromatic Buttons */
  .btn-update-mono {
    background-color: #121212 !important;
    color: #FFFFFF !important;
    border: 1px solid #121212 !important;
    border-radius: 10px;
    padding: 0.7rem 1.75rem;
    font-weight: 600;
    opacity: 1 !important;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .btn-update-mono:hover {
    background-color: #343A40 !important;
    border-color: #343A40 !important;
    color: #FFFFFF !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .btn-back-mono {
    background-color: #FFFFFF !important;
    color: #121212 !important;
    border: 1px solid #CED4DA !important;
    border-radius: 10px;
    padding: 0.7rem 1.5rem;
    font-weight: 600;
    opacity: 1 !important;
    text-decoration: none;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .btn-back-mono:hover {
    background-color: #E9ECEF !important;
    border-color: #ADB5BD !important;
    color: #121212 !important;
  }

  .border-top-mono {
    border-top: 1px solid var(--border-color) !important;
  }

  @media(max-width: 768px) {
    .page-header {
      padding: 1.5rem;
    }

    .form-card {
      padding: 1.5rem;
    }
  }
</style>

<div class="container my-4">

  {{-- Header Section --}}
  <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
      <h2 class="serif-font fw-bold m-0 fs-2">Edit Produk</h2>
      <p class="text-white-50 m-0 mt-1">
        Perbarui informasi produk <strong>{{ $produk->nama ?? $produk->name }}</strong> agar data tetap akurat.
      </p>
    </div>
    <div>
      <a href="{{ route('produk.index') }}" class="btn btn-back-mono">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
    </div>
  </div>

  {{-- Form Card --}}
  <div class="form-card">
    <form action="{{ route('produk.update', $produk) }}"
          method="POST"
          enctype="multipart/form-data">

      @csrf
      @method('PUT')

      @include('Produk._form')

      <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top-mono">
        <a href="{{ route('produk.index') }}" class="btn btn-back-mono">
          Batal
        </a>

        <button type="submit" class="btn btn-update-mono">
          <i class="bi bi-arrow-repeat"></i> Perbarui Produk
        </button>
      </div>

    </form>
  </div>

</div>

@endsection