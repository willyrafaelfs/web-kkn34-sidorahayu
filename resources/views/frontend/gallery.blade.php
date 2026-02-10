@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1>Galeri Dokumentasi</h1>
        <p>Rekaman jejak kegiatan kami selama mengabdi.</p>
    </div>

    <div class="row g-4">
        @forelse($galleries as $gallery)
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 border-0 shadow-sm">
                    
                    @if($gallery->category == 'video' || $gallery->file_type == 'link')
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ str_replace('watch?v=', 'embed/', $gallery->file_path) }}" allowfullscreen class="rounded-top"></iframe>
                        </div>
                        <div class="card-body bg-dark text-white">
                            <h6 class="card-title mb-0"><i class="bi bi-play-circle me-2"></i> {{ $gallery->title }}</h6>
                        </div>
                    @else
                        <a href="{{ asset('storage/'.$gallery->file_path) }}" target="_blank">
                            <img src="{{ asset('storage/'.$gallery->file_path) }}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="{{ $gallery->title }}">
                        </a>
                        <div class="card-body">
                            <h6 class="card-title">{{ $gallery->title }}</h6>
                            <p class="card-text text-muted small">{{ $gallery->description }}</p>
                        </div>
                    @endif

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada galeri yang diupload.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection