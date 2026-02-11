@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1>Galeri Dokumentasi</h1>
        <p>Rekaman jejak kegiatan kami selama mengabdi.</p>
    </div>

    <div class="row g-4">
        @foreach($galleries as $gallery)
    <div class="col-md-4 col-sm-6">
        <div class="card h-100 border-0 shadow-sm">
            
            @php
                $extension = pathinfo($gallery->file_path, PATHINFO_EXTENSION);
            @endphp

            @if($gallery->file_type == 'link')
                <div class="ratio ratio-16x9">
                    <iframe src="{{ $gallery->youtube_embed }}" allowfullscreen class="rounded-top"></iframe>
                </div>

            @elseif(in_array(strtolower($extension), ['mp4', 'mov', 'avi']))
                 <div class="ratio ratio-16x9">
                    <video controls class="rounded-top object-fit-cover">
                        <source src="{{ asset('storage/'.$gallery->file_path) }}" type="video/mp4">
                        Browser Anda tidak mendukung tag video.
                    </video>
                </div>

            @else
                <a href="{{ asset('storage/'.$gallery->file_path) }}" target="_blank">
                    <img src="{{ asset('storage/'.$gallery->file_path) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                </a>
            @endif

            <div class="card-body">
                <h6 class="card-title">{{ $gallery->title }}</h6>
                <p class="card-text text-muted small">{{ $gallery->description }}</p>
            </div>
        </div>
    </div>
@endforeach
    </div>
</div>
@endsection