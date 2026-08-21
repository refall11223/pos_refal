@php
    $isAdmin = (optional(auth()->user()->role)->name === 'admin' || auth()->user()->role === 'admin');
@endphp

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top tshirt-navbar">
    <div class="container">

        <a class="navbar-brand fw-bold d-flex align-items-center serif-font" href="{{ route('dashboard') }}">
            <i class="bi bi-tag-fill me-2"></i>
            T-Shirt POS
        </a>

        <button class="navbar-toggler border-0" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-grid-fill me-1"></i>
                        Beranda
                    </a>
                </li>

                {{-- Menu Users HANYA TAMPIL untuk Admin --}}
                @if($isAdmin)
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}"
                           href="{{ route('admin.users') }}">
                            <i class="bi bi-people-fill me-1"></i>
                            Users
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('produk*') ? 'active' : '' }}"
                       href="{{ route('produk.index') }}">
                        <i class="bi bi-box-seam me-1"></i>
                        Produk
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('penjualan*') ? 'active' : '' }}"
                       href="{{ route('penjualan.index') }}">
                        <i class="bi bi-cart-check-fill me-1"></i>
                        Penjualan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('tentang*') ? 'active' : '' }}"
                       href="{{ route('tentang') }}">
                        <i class="bi bi-person-badge-fill me-1"></i>
                        Tentang Saya
                    </a>
                </li>

            </ul>

            <div class="d-flex align-items-center gap-3">

                <div class="user-info text-white">

                    <small class="d-block opacity-75">
                        Selamat Datang
                    </small>

                    <strong>
                        {{ Auth::user()->name ?? 'Pengguna' }}
                    </strong>

                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-outline-light btn-sm px-3 rounded-pill btn-logout">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </div>
</nav>

<style>
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&display=swap');

.tshirt-navbar {
    background: linear-gradient(135deg, #121212 0%, #2B2B2B 100%);
    padding: 12px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.serif-font {
    font-family: 'Cinzel', serif;
    letter-spacing: 0.5px;
}

.navbar-brand {
    font-size: 1.35rem;
    letter-spacing: .5px;
    color: #FFFFFF !important;
}

.nav-link {
    color: rgba(255, 255, 255, 0.75) !important;
    font-weight: 500;
    margin: 0 4px;
    padding: 8px 16px !important;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.nav-link:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #FFFFFF !important;
}

.nav-link.active {
    background: rgba(255, 255, 255, 0.18);
    color: #FFFFFF !important;
    font-weight: 600;
}

.user-info {
    text-align: right;
}

.btn-logout {
    font-weight: 600;
    border-color: rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
}

.btn-logout:hover {
    background-color: #FFFFFF;
    color: #121212;
    border-color: #FFFFFF;
    transform: translateY(-2px);
}

@media (max-width: 991px) {
    .user-info {
        text-align: left;
        margin-top: 15px;
    }
}
</style>