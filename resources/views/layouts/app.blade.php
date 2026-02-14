<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'KKN 34 Sidorahayu' }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <div class="d-flex gap-2 me-2">
                    <img src="{{ $sets['logo_header_1'] ? asset('storage/'.$sets['logo_header_1']) : 'https://placehold.co/40' }}" style="height: 40px;">
                    <img src="{{ $sets['logo_header_2'] ? asset('storage/'.$sets['logo_header_2']) : 'https://placehold.co/40' }}" style="height: 40px;">
                    <img src="{{ $sets['logo_header_3'] ? asset('storage/'.$sets['logo_header_3']) : 'https://placehold.co/40' }}" style="height: 40px;">
                </div>
                <div class="d-none d-md-block ms-2 lh-1">
                    <span class="d-block fw-bold" style="font-size: 0.9rem;">KKN KELOMPOK 34</span>
                    <small class="text-muted" style="font-size: 0.75rem;">Desa Sidorahayu</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Tentang Kami</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profil.desa') }}">Profil Desa</a></li>
                            <li><a class="dropdown-item" href="{{ route('lokasi') }}">Lokasi & Peta</a></li>
                            <li><a class="dropdown-item" href="{{ route('team') }}">Tim KKN</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Program Kerja</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('proker.show', 'proker-hidroponik') }}">Hidroponik</a></li>
                            <li><a class="dropdown-item" href="{{ route('proker.show', 'proker-sekolah') }}">Sosialisasi SD</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Publikasi</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('news') }}">Berita</a></li>
                            <li><a class="dropdown-item" href="{{ route('gallery') }}">Media & Galeri</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('guestbook') }}">Sapa Kami</a></li>

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
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="bg-dark text-white pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <img src="{{ isset($sets['logo_footer']) && $sets['logo_footer'] ? asset('storage/'.$sets['logo_footer']) : 'https://placehold.co/80' }}" 
         alt="Logo Kelompok" 
         class="mb-3 rounded-circle bg-white p-1" 
         style="width: 40px; height: 40px; object-fit: contain;">
                    <h5 class="fw-bold">KKN KELOMPOK 34</h5>
                    <p class="small text-white-50">
                        Mengabdi dengan hati di Desa Sidorahayu.<br>
                        Membangun desa, memajukan bangsa.
                    </p>
                    
                    <div class="mt-3">
                        <a href="https://www.instagram.com/kknsidorahayu2026?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="text-white me-3 text-decoration-none">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>
                        <a href="https://www.tiktok.com/@kkn_sidorahayu34?is_from_webapp=1&sender_device=pc" target="_blank" class="text-white text-decoration-none">
                            <i class="bi bi-tiktok fs-4"></i>
                        </a>
    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Akses Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                        <li><a href="{{ route('profil.desa') }}" class="text-white-50 text-decoration-none">Profil Desa</a></li>
                        <li><a href="{{ route('news') }}" class="text-white-50 text-decoration-none">Berita Terkini</a></li>
                        <li><a href="{{ route('guestbook') }}" class="text-white-50 text-decoration-none">Sapa Kami</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-envelope me-2 text-warning"></i> 
                            <a href="mailto:kkn34@univ.ac.id" class="text-white text-decoration-none">kkndesasidorahayu34@gmail.com</a>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-whatsapp me-2 text-success"></i> 
                            <a href="https://wa.me/6282267039811" class="text-white text-decoration-none">08 berapa dek?</a>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt me-2 text-danger"></i> 
                            <span class="text-white-50">Posko: Dusun Tulus Ayu, Desa Sidorahayu</span>
                        </li>
<!-- Footer Credit Section -->
<div class="mt-5 pt-4 border-top border-secondary text-center">
    <p class="text-white-50" style="font-size: 0.85rem; letter-spacing: 0.5px;">
        Designed & Developed by
        <i class="bi bi-heart-fill text-danger heartbeat" 
           style="cursor: help;" 
           title="Dibuat dengan begadang"></i> 
        by 
        <a href="https://www.instagram.com/pistarr.7/?__pwa=1#" target="_blank" class="text-warning text-decoration-none credit-link">
            Willy Rafael
        </a>
    </p>
</div>

<style>
    .heartbeat {
        display: inline-block;
        animation: heartBeat 1.5s ease-in-out infinite;
    }

    @keyframes heartBeat {
        0%, 70%, 100% { transform: scale(1); }
        14% { transform: scale(1.25); }
        28% { transform: scale(1); }
        42% { transform: scale(1.25); }
    }

    .credit-link {
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
    }

    .credit-link:hover {
        color: #ffffff !important;
        text-shadow: 0 0 10px rgba(255, 193, 7, 0.8);
    }
    
    .credit-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 1px;
        bottom: -2px;
        left: 0;
        background-color: #ffc107;
        transition: width 0.3s;
    }
    
    .credit-link:hover::after {
        width: 100%;
    }
</style>

                    </ul>
                </div>
            </div>
            
            <hr class="border-secondary">
            
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <small>&copy; 2026 KKN Kelompok 34 - Universitas Merdeka Malang. All rights reserved.</small>
                <small>
                    <a href="{{ route('login') }}" class="text-secondary text-decoration-none ms-2">Admin Area</a>
                </small>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    @stack('scripts')
</body>
</html>