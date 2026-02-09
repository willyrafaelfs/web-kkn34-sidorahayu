<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'KKN 34 Sidorahayu' }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="https://placehold.co/40" alt="Logo" class="me-2 rounded-circle"> 
                <div>
                    <span class="d-block fw-bold" style="font-size: 0.9rem;">KKN KELOMPOK 34</span>
                    <small class="text-muted" style="font-size: 0.75rem;">Desa Sidorahayu</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Tentang Kami
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profil.desa') }}">Profil Desa</a></li>
                            <li><a class="dropdown-item" href="{{ route('lokasi') }}">Lokasi & Peta</a></li>
                            <li><a class="dropdown-item" href="{{ route('team') }}">Tim KKN</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Program Kerja
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('proker.show', 'hidroponik') }}">Hidroponik</a></li>
                            <li><a class="dropdown-item" href="{{ route('proker.show', 'sosialisasi-edukasi') }}">Sosialisasi SD</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Publikasi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('news') }}">Berita Terkini</a></li>
                            <li><a class="dropdown-item" href="{{ route('gallery') }}">Media & Galeri</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guestbook') }}">Buku Tamu</a>
                    </li>

                    <li class="nav-item ms-lg-3">
                        @guest
                            <a href="{{ route('google.login') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                <i class="bi bi-google me-1"></i> Login
                            </a>
                        @else
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle fw-bold text-primary" href="#" role="button" data-bs-toggle="dropdown">
                                    Halo, {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    @if(Auth::user()->role == 'admin')
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                                    @endif
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Keluar
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>KKN Kelompok 34</h5>
                    <p>Mengabdi dengan sepenuh hati di Desa Sidorahayu.</p>
                </div>
                <div class="col-md-4">
                    <h5>Menu</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                        <li><a href="{{ route('news') }}" class="text-white text-decoration-none">Berita</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Kontak</h5>
                    <p>Email: kkn34@univ.ac.id</p>
                </div>
            </div>
            <hr>
            <div class="left">
                <small>&copy; 2026 KKN Kelompok 34 Sidorahayu.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    @stack('scripts')
</body>
</html>