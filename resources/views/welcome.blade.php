@extends('layouts.app')

@section('content')

<header id="hero" class="text-center py-5">
    <h1>Selamat Datang di Desa Sidorahayu</h1>
    <p>KKN Kelompok 34 - Universitas ...</p>
    <a href="#proker" class="btn btn-primary">Lihat Kegiatan Kami</a>
</header>

<section id="proker" class="container py-5">
    <h2 class="text-center mb-4">Program Unggulan</h2>
    <div class="row">
        @foreach($proker_utama as $proker)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <img src="{{ $proker->image_path ? asset('storage/'.$proker->image_path) : 'https://placehold.co/600x400' }}" class="card-img-top" alt="{{ $proker->title }}">
                    <div class="card-body">
                        <h3>{{ $proker->title }}</h3>
                        <p>{{Str::limit(strip_tags($proker->body), 100)}}</p>
                        <a href="{{ route('posts.show', $proker->slug) }}" class="btn btn-outline-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section id="berita" class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Kabar Terbaru</h2>
        <div class="row">
            @foreach($latest_posts as $post)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ $post->image_path ? asset('storage/'.$post->image_path) : 'https://placehold.co/600x400' }}" class="card-img-top" alt="{{ $post->title }}">
                        <div class="card-body">
                            <span class="badge bg-info">{{ $post->category->name }}</span>
                            <h5 class="card-title mt-2">{{ $post->title }}</h5>
                            <small class="text-muted">{{ $post->created_at->format('d M Y') }}</small>
                            <a href="{{ route('posts.show', $post->slug) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('news') }}" class="btn btn-secondary">Lihat Semua Berita</a>
        </div>
    </div>
</section>

<section id="galeri" class="container py-5">
    <h2 class="text-center mb-4">Dokumentasi & Media</h2>
    <div class="row">
        @foreach($galleries as $gallery)
            <div class="col-md-4 mb-3">
                <div class="card">
                    @if($gallery->category == 'video' && $gallery->file_type == 'link')
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ str_replace('watch?v=', 'embed/', $gallery->file_path) }}" allowfullscreen></iframe>
                        </div>
                    @else
                        <img src="{{ asset('storage/'.$gallery->file_path) }}" class="img-fluid">
                    @endif
                    <div class="card-body text-center">
                        <h6>{{ $gallery->title }}</h6>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection