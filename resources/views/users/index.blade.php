@extends('layouts.app')

@section('title', 'Manajemen Users')

@section('content')

@include('layouts.navbar')

{{-- Import Font Clean & Professional --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Roboto+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  :root {
    --color-blue: #2563EB;
    --color-black: #0F172A;
    --color-gray: #94A3B8;
  }

  /* Base Typography Settings */
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
    position: relative;
    overflow: hidden;
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

  .search-box .form-control:focus {
    box-shadow: none;
    border-color: var(--color-blue);
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

  /* Font Monospace untuk Angka & Email */
  .font-number {
    font-family: 'Roboto Mono', monospace;
    font-size: 0.85rem;
  }

  /* Role Badges */
  .badge-role {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 500;
  }

  .badge-role-admin {
    background-color: rgba(37, 99, 235, 0.2);
    color: #93C5FD;
    border: 1px solid rgba(37, 99, 235, 0.3);
  }

  .badge-role-user {
    background-color: rgba(148, 163, 184, 0.15);
    color: #E2E8F0;
    border: 1px solid rgba(148, 163, 184, 0.25);
  }

  .badge-role-default {
    background-color: rgba(15, 23, 42, 0.6);
    color: var(--color-gray);
    border: 1px solid rgba(255, 255, 255, 0.1);
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

  /* Pagination */
  .page-link {
    color: #94A3B8;
    background-color: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
    font-size: 0.85rem;
  }

  .page-item.active .page-link {
    background-color: var(--color-blue);
    border-color: var(--color-blue);
    color: #FFFFFF;
  }
</style>

<div class="container my-4">

  @if(session('errors'))
    <div class="alert alert-danger border-0 bg-danger text-white bg-opacity-75 rounded-3 mb-3 fs-7">
      {{ session('errors') }}
    </div>
  @endif
  
  {{-- Header Section --}}
  <div class="dashboard-header d-flex align-items-center justify-content-between flex-wrap gap-3">
    <div>
      <div class="header-badge">
        <i class="bi bi-people"></i> Pengguna
      </div>
      <h1 class="brand-title">Manajemen User</h1>
      <p class="text-description m-0">Kelola data pengguna, hak akses, dan peran sistem.</p>
    </div>
  </div>

  {{-- Main Card --}}
  <div class="luxury-card">
    <div class="row g-2 justify-content-between align-items-center mb-3">
      <div class="col-md-5 col-lg-4">
        <a href="{{ route('admin.users.create') }}" class="btn btn-create d-inline-flex align-items-center gap-2">
          <i class="bi bi-person-plus-fill"></i> Tambah User Baru
        </a>
      </div>

      <div class="col-md-7 col-lg-5">
        <form action="{{ route('admin.users') }}" method="GET">
          <div class="input-group search-box">
            <input
              type="text"
              name="search"
              value="{{ request('search') }}"
              class="form-control"
              placeholder="Cari nama atau email user..."
            >
            <button class="btn btn-search" type="submit">
              <i class="bi bi-search me-1"></i> Cari
            </button>
          </div>
        </form>
      </div>
    </div>

    {{-- Tabel --}}
    <div class="table-responsive">
      <table class="table table-custom align-middle">
        <thead>
          <tr>
            <th scope="col" class="text-center" style="width: 40px;">#</th>
            <th scope="col">Nama Pengguna</th>
            <th scope="col">Email</th>
            <th scope="col" class="text-center">Peran (Role)</th>      
            <th scope="col" class="text-center" style="width: 150px;">Aksi</th>      
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
          @php
              $roleName = is_object($user->role) ? ($user->role->name ?? '-') : ($user->role ?? '-');
              $roleLower = strtolower($roleName);
          @endphp
          <tr>
            <td class="text-center text-white-50 font-number">{{ $users->firstItem() + $loop->index }}</td>
            <td class="fw-semibold text-white">
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-person-circle text-white-50 fs-6"></i>
                <span>{{ $user->name }}</span>
              </div>
            </td>
            <td class="text-white-50 font-number">{{ $user->email }}</td>
            <td class="text-center">
              @if($roleLower == 'admin')
                <span class="badge-role badge-role-admin"><i class="bi bi-shield-lock-fill"></i> {{ $roleName }}</span>
              @elseif(in_array($roleLower, ['user', 'kasir']))
                <span class="badge-role badge-role-user"><i class="bi bi-person-badge"></i> {{ $roleName }}</span>
              @else
                <span class="badge-role badge-role-default">{{ $roleName }}</span>
              @endif
            </td>
            <td>
              <div class="d-flex justify-content-center align-items-center gap-1">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-action btn-action-edit text-decoration-none" title="Edit">
                  <i class="bi bi-pencil-square"></i> Edit
                </a>
                
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-action btn-action-delete" onclick="return confirm('Yakin ingin menghapus user ini?')" title="Hapus">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-white-50 text-center py-4">
              <i class="bi bi-person-exclamation fs-3 d-block text-white-50 mb-1"></i>
              Tidak ada data user yang ditemukan.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      {{ $users->links() }}
    </div>
  </div>

</div>

@endsection