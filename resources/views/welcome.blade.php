@extends('layouts.app')

@section('content')

<header id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active" style="height: 800px;">
            <div class="overlay" style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);"></div>
            <img src="{{ $sets['hero_image'] ? asset('storage/'.$sets['hero_image']) : 'https://placehold.co/1920x750' }}" class="d-block w-100 h-100 object-fit-cover" alt="Desa Sidorahayu">
            <div class="carousel-caption d-none d-md-block pb-5">
                <h1 class="display-4 fw-bold">SELAMAT DATANG DI DESA SIDORAHAYU</h1>
                <p class="lead">MEMBANGUN DIRI🌟, MEMBANGUN DESA🏗️.</p>
                <a href="#proker" class="btn btn-warning btn-lg mt-3">Lihat Program Kami</a>
            </div>
        </div>

        <div class="carousel-item" style="height: 800px;">
            <div class="overlay" style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.4);"></div>
            <video class="d-block w-100 h-100 object-fit-cover" autoplay muted loop>
                <source src="{{ $sets['hero_video'] ? asset('storage/'.$sets['hero_video']) : 'https://www.w3schools.com/html/mov_bbb.mp4' }}" type="video/mp4">
            </video>
            <div class="carousel-caption d-none d-md-block pb-5">
                <h1 class="display-4 fw-bold">POTENSI HIDROPONIK DESA</h1>
                <p class="lead">MEWUJUDKAN KETAHANAN PANGAN MANDIRI MELALUI TEKNOLOGI PERTANIAN MODERN.</p>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</header>

<section id="proker" class="container py-5">
    <div class="text-center mb-5">
        <P><h2 class="fw-bold">Fokus Program Kerja</h2></P>
        <p class="text-muted text-nowrap">Dua pilar utama pengabdian kami di Desa Sidorahayu.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow hover-card overflow-hidden">
                <div class="row g-0 h-100">
                    <div class="col-md-6">
                        <img src="{{ $sets['proker_hidroponik_thumb'] ? asset('storage/'.$sets['proker_hidroponik_thumb']) : 'https://placehold.co/400x400' }}" class="img-fluid h-100 object-fit-cover" alt="Hidroponik">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="card-body">
                            <div class="badge bg-success mb-2">Ekonomi & Pangan</div>
                            <h4 class="card-title fw-bold">Program Hidroponik</h4>
                            <p class="card-text text-muted small">
                                Pengembangan 100 lubang tanam sistem DFT dan pelatihan nutrisi AB Mix untuk warga oleh bombang.
                            </p>
                            <a href="{{ route('proker.show', 'proker-hidroponik') }}" class="btn btn-outline-success btn-sm stretched-link">
                                Pelajari Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 border-0 shadow hover-card overflow-hidden">
                <div class="row g-0 h-100">
                    <div class="col-md-6">
                        <img src="{{ $sets['proker_sekolah_thumb'] ? asset('storage/'.$sets['proker_sekolah_thumb']) : 'https://placehold.co/400x401' }}" class="img-fluid h-100 object-fit-cover" alt="Sekolah">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="card-body">
                            <div class="badge bg-primary mb-2">Pendidikan</div>
                            <h4 class="card-title fw-bold">Sidorahayu Cerdas</h4>
                            <p class="card-text text-muted small">
                                Pendampingan belajar, sosialisasi peduli lingkungan, dan makanan sehat di SDN 3 Sidorahayu.
                            </p>
                            <a href="{{ route('proker.show', 'proker-sekolah') }}" class="btn btn-outline-primary btn-sm stretched-link">
                                Pelajari Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="berita" class="bg-light py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">Kabar Terbaru</h2>
            <a href="{{ route('news') }}" class="btn btn-outline-secondary btn-sm">Lihat Semua Berita</a>
        </div>
        
        <div class="row">
            @foreach($latest_posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ $post->image_path ? asset('storage/'.$post->image_path) : 'https://placehold.co/600x400' }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $post->title }}">
                        <div class="card-body">
                            <div class="mb-2">
                                <span class="badge bg-secondary">{{ $post->category->name }}</span>
                                <small class="text-muted ms-2">{{ $post->created_at->format('d M Y') }}</small>
                            </div>
                            <h5 class="card-title fw-bold text-truncate">{{ $post->title }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit(strip_tags($post->excerpt), 80) }}</p>
                            <a href="{{ route('posts.show', $post->slug) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="tim" class="py-5 bg-white">
    <div class="container text-center">
        <div class="mb-5">
            <h2 class="fw-bold">Tim KKN Kelompok 34</h2>
            <p class="text-muted">DPL dan Mahasiswa Universitas Merdeka Malang yang mengabdi di Desa Sidorahayu.</p>
        </div>

        <div class="row justify-content-center">
            @foreach($teams as $team)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm py-3 hover-top">
                        <div class="card-body">
                            <img src="{{ $team->photo_path ? asset('storage/'.$team->photo_path) : 'https://placehold.co/150' }}" 
                                 class="rounded-circle mb-3 border border-3 border-light shadow-sm" 
                                 style="width: 120px; height: 120px; object-fit: cover;" 
                                 alt="{{ $team->name }}">
                            
                            <h5 class="fw-bold mb-1">{{ $team->name }}</h5>
                            <p class="text-primary small mb-2 fw-bold text-uppercase">{{ $team->position }}</p>
                            <p class="text-muted small mb-0">{{ $team->major }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <a href="{{ route('team') }}" class="btn btn-outline-primary rounded-pill px-4">
                Lihat Seluruh Anggota Tim <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container text-center">
        <h2 class="mb-4 fw-bold">Galeri Kegiatan</h2>
        <div class="row g-2">
            @foreach($galleries->take(5) as $gallery)
                <div class="col-md-3 col-6">
                    @if($gallery->file_type == 'link' && $gallery->youtube_id)
                        <div class="ratio ratio-1x1 position-relative">
                            <a href="#" class="open-video d-block" data-bs-toggle="modal" data-bs-target="#videoModal" data-src="{{ $gallery->youtube_embed }}">
                                <img src="{{ $gallery->youtube_thumbnail }}" class="rounded shadow-sm w-100 h-100 object-fit-cover" alt="{{ $gallery->title }}">
                                <span class="position-absolute top-50 start-50 translate-middle">
                                    <i class="bi bi-play-circle-fill" style="font-size:36px; color:rgba(255,255,255,0.9)"></i>
                                </span>
                            </a>
                        </div>

                    @elseif($gallery->file_type == 'upload')
                        @php
                            $ext = pathinfo($gallery->file_path, PATHINFO_EXTENSION);
                        @endphp

                        @if(in_array(strtolower($ext), ['mp4', 'mov', 'avi']))
                            <div class="ratio ratio-1x1">
                                <video src="{{ asset('storage/'.$gallery->file_path) }}" class="rounded shadow-sm object-fit-cover w-100 h-100 bg-dark" controls></video>
                            </div>
                        @else
                            <div class="ratio ratio-1x1">
                                <img src="{{ asset('storage/'.$gallery->file_path) }}" class="rounded shadow-sm object-fit-cover w-100 h-100" alt="{{ $gallery->title }}">
                            </div>
                        @endif
                    @else
                        {{-- non-YouTube link atau unknown: tampilkan link langsung --}}
                        <div class="ratio ratio-1x1">
                            <a href="{{ $gallery->file_path }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ $gallery->youtube_thumbnail ?? asset('storage/'.$gallery->file_path) }}" class="rounded shadow-sm w-100 h-100 object-fit-cover" alt="{{ $gallery->title }}">
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <a href="{{ route('gallery') }}" class="btn btn-dark">Lihat Galeri Lengkap</a>
        </div>
    </div>
</section>

{{-- Modal Bootstrap (letakkan sekali di layout atau di bawah section ini) --}}
<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0">
        <div class="ratio ratio-16x9">
          <iframe id="videoIframe" src="" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var videoModal = document.getElementById('videoModal');
    var iframe = document.getElementById('videoIframe');

    document.querySelectorAll('.open-video').forEach(function(el){
        el.addEventListener('click', function(e){
            e.preventDefault();
            var src = this.getAttribute('data-src');
            iframe.src = src + '?rel=0&modestbranding=1&autoplay=1';
        });
    });

    videoModal.addEventListener('hidden.bs.modal', function () {
        iframe.src = '';
    });
});
</script>
@endpush


<section id="kontak" class="py-5 bg-white border-top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold">Ada Pertanyaan?</h2>
                <p class="text-muted">Jangan ragu untuk menghubungi kami jika ada saran atau pertanyaan seputar program kerja KKN.</p>
                </div>
            <div class="col-md-6">
                @if(session('success_message'))
                    <div class="alert alert-success">{{ session('success_message') }}</div>
                @endif
                <form action="{{ route('messages.store') }}" method="POST" class="card p-4 shadow-sm border-0 bg-light">
                    @csrf
                    <div class="mb-3">
                        <label>Nama Anda</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kontak (Email/WA)</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Pesan</label>
                        <textarea name="message" rows="3" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection