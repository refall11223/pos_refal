@extends('layouts.app')

@section('title', 'Manajemen Users')

@section('content')

@include('layouts.navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  :root {
    --bg-main: #F8F9FA;
    --card-bg: #FFFFFF;
    --primary-black: #121212;
    --soft-black: #2B2B2B;
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
    border-radius: 20px;
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

  /* Card Container */
  .content-card {
    background: var(--card-bg);
    border-radius: 20px;
    border: 1px solid var(--border-color);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.03);
    padding: 2rem;
  }

  /* Custom Search Form */
  .search-box .form-control {
    border-radius: 12px 0 0 12px;
    border: 1px solid var(--border-color);
    padding: 0.65rem 1.2rem;
    background-color: var(--bg-main);
    color: var(--primary-black);
  }

  .search-box .form-control:focus {
    box-shadow: none;
    border-color: var(--primary-black);
    background-color: #FFFFFF;
  }

  .search-box .btn-search {
    background-color: var(--primary-black);
    color: #FFFFFF;
    border-radius: 0 12px 12px 0;
    padding: 0.65rem 1.4rem;
    font-weight: 600;
    border: 1px solid var(--primary-black);
    transition: all 0.3s ease;
  }

  .search-box .btn-search:hover {
    background-color: var(--soft-black);
    color: #FFFFFF;
  }

  /* Action Buttons */
  .btn-create {
    background-color: var(--primary-black);
    color: #FFFFFF;
    border: 1px solid var(--primary-black);
    border-radius: 12px;
    padding: 0.7rem 1.4rem;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .btn-create:hover {
    background-color: #FFFFFF;
    color: var(--primary-black);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  }

  /* Table Custom Styling */
  .table-custom {
    margin-bottom: 0;
  }

  .table-custom thead th {
    background: var(--bg-main);
    border-bottom: 2px solid var(--border-color);
    color: var(--primary-black);
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
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

  /* Role Badges */
  .badge-role-admin {
    background-color: var(--primary-black);
    color: #FFFFFF;
    border: 1px solid var(--primary-black);
    padding: 6px 14px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 0.75rem;
  }

  .badge-role-user {
    background-color: #495057;
    color: #FFFFFF;
    border: 1px solid #495057;
    padding: 6px 14px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 0.75rem;
  }

  .badge-role-default {
    background-color: var(--bg-main);
    color: var(--text-muted);
    border: 1px solid #CED4DA;
    padding: 6px 14px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 0.75rem;
  }

  /* Custom Action Buttons in Table */
  .btn-action-edit {
    background-color: var(--bg-main);
    color: var(--primary-black);
    border: 1px solid #CED4DA;
    border-radius: 10px;
    padding: 6px 14px;
    font-weight: 600;
    font-size: 0.825rem;
    transition: all 0.2s ease;
  }

  .btn-action-edit:hover {
    background-color: #E9ECEF;
    color: var(--primary-black);
    border-color: #ADB5BD;
  }

  .btn-action-delete {
    background-color: #FFFFFF;
    color: #DC3545;
    border: 1px solid #DC3545;
    border-radius: 10px;
    padding: 6px 14px;
    font-weight: 600;
    font-size: 0.825rem;
    transition: all 0.2s ease;
  }

  .btn-action-delete:hover {
    background-color: #DC3545;
    color: #FFFFFF;
  }

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

<div class="container my-4">
  <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
      <h2 class="serif-font fw-bold m-0 fs-2">Manajemen User</h2>
      <p class="text-white-50 m-0 mt-1">Kelola data pengguna, hak akses, dan peran sistem.</p>
    </div>
    <div class="d-none d-md-block">
      <i class="bi bi-people display-4 text-white" style="opacity: 0.15;"></i>
    </div>
  </div>

  <div class="content-card">
    <div class="row g-3 justify-content-between align-items-center mb-4">
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

    <div class="table-responsive">
      <table class="table table-custom align-middle">
        <thead>
          <tr>
            <th scope="col" style="width: 5%;">#</th>
            <th scope="col">Nama Pengguna</th>
            <th scope="col">Email</th>
            <th scope="col" class="text-center">Peran (Role)</th>      
            <th scope="col" class="text-center" style="width: 20%;">Aksi</th>      
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
          @php
              // Penanganan kondisi aman jika role berupa object relation atau kolom string
              $roleName = is_object($user->role) ? ($user->role->name ?? '-') : ($user->role ?? '-');
              $roleLower = strtolower($roleName);
          @endphp
          <tr>
            <td class="text-muted fs-7">{{ $users->firstItem() + $loop->index }}</td>
            <td class="fw-bold text-dark">
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-person-circle text-muted fs-5"></i>
                <span>{{ $user->name }}</span>
              </div>
            </td>
            <td class="text-secondary">{{ $user->email }}</td>
            <td class="text-center">
              @if($roleLower == 'admin')
                <span class="badge-role-admin"><i class="bi bi-shield-lock-fill me-1"></i> {{ $roleName }}</span>
              @elseif(in_array($roleLower, ['user', 'kasir']))
                <span class="badge-role-user"><i class="bi bi-person-badge me-1"></i> {{ $roleName }}</span>
              @else
                <span class="badge-role-default">{{ $roleName }}</span>
              @endif
            </td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-action-edit text-decoration-none">
                  <i class="bi bi-pencil-square me-1"></i> Edit
                </a>
                
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-action-delete" onclick="return confirm('Yakin ingin menghapus user ini?')">
                    <i class="bi bi-trash3 me-1"></i> Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-muted text-center py-5">
              <i class="bi bi-person-exclamation fs-1 d-block text-muted mb-2"></i>
              Tidak ada data user yang ditemukan.
            </td>
          </tr>
          @endempty
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $users->links() }}
    </div>
  </div>
</div>

@endsection