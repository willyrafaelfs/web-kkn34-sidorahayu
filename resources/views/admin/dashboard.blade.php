@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2>Dashboard Admin</h2>
        <span class="text-muted">Halo, {{ Auth::user()->name }}</span>
    </div>

    <div class="row mb-5">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body text-center">
                    <h1>{{ $total_posts }}</h1>
                    <p>Artikel Berita</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark h-100">
                <div class="card-body text-center">
                    <h1>{{ $unread_messages }}</h1>
                    <p>Pesan Baru</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body text-center">
                    <h1>{{ $today_visitors }}</h1>
                    <p>Pengunjung Hari Ini</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-secondary text-white h-100">
                <div class="card-body text-center">
                    <h1>{{ $total_visitors }}</h1>
                    <p>Total Pengunjung</p>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3">Kelola Konten</h4>
    <div class="row">
        <div class="col-md-4 mb-3">
            <a href="{{ route('admin.posts.index') }}" class="text-decoration-none">
                <div class="card h-100 hover-shadow">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle p-3 me-3">
                            <i class="bi bi-newspaper fs-4"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0 text-dark">Kelola Berita</h5>
                            <small class="text-muted">Tulis artikel & kegiatan</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="{{ route('admin.galleries.index') }}" class="text-decoration-none">
                <div class="card h-100 hover-shadow">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-danger text-white rounded-circle p-3 me-3">
                            <i class="bi bi-images fs-4"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0 text-dark">Kelola Galeri</h5>
                            <small class="text-muted">Upload foto & video</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="{{ route('admin.messages.index') }}" class="text-decoration-none"> <div class="card h-100 hover-shadow">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-warning text-dark rounded-circle p-3 me-3">
                            <i class="bi bi-envelope fs-4"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0 text-dark">Kotak Masuk</h5>
                            <small class="text-muted">Baca pesan dari warga</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>

<div class="col-md-4 mb-3">
    <a href="{{ route('admin.comments.index') }}" class="text-decoration-none">
        <div class="card h-100 hover-shadow">
            <div class="card-body d-flex align-items-center">
                <div class="bg-warning text-dark rounded-circle p-3 me-3">
                    <i class="bi bi-chat-dots-fill fs-4"></i>
                </div>
                <div>
                    <h5 class="card-title mb-0 text-dark">Komentar Berita</h5>
                    <small class="text-muted">Moderasi Diskusi</small>
                </div>
            </div>
        </div>
    </a>
</div>

        <div class="col-md-4 mb-3">
            <a href="{{ route('admin.teams.index') }}" class="text-decoration-none">
                    <div class="card h-100 hover-shadow">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-info text-white rounded-circle p-3 me-3">
                                <i class="bi bi-people fs-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0 text-dark">Tim KKN</h5>
                                <small class="text-muted">{{ $total_team }} Anggota Terdaftar</small>
                            </div>
                        </div>
                    </div>
            </a>
        </div>
    </div>

    <div class="col-md-4 mb-3">
    <a href="{{ route('admin.settings.index') }}" class="text-decoration-none">
        <div class="card h-100 hover-shadow">
            <div class="card-body d-flex align-items-center">
                <div class="bg-secondary text-white rounded-circle p-3 me-3">
                    <i class="bi bi-gear-fill fs-4"></i>
                </div>
                <div>
                    <h5 class="card-title mb-0 text-dark">Pengaturan</h5>
                    <small class="text-muted">Logo, Banner & Tampilan</small>
                </div>
            </div>
        </div>
    </a>
</div>
    
    <div class="mt-5 text-center">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Website Utama
        </a>
    </div>
</div>
@endsection