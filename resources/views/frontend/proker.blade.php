@extends('layouts.app')

@section('content')

<div class="bg-light py-5 mb-5">
    <div class="container text-center">
        <h1 class="fw-bold mb-3">{{ $category->name }}</h1>
        
<div class="row justify-content-center">
    <div class="col-lg-8">
        @if($category->slug == 'proker-hidroponik')
            <p class="lead">
                Fokus utama KKN kami: Mengembangkan pertanian modern.
                Kegiatan mencakup pembangunan instalasi, pelatihan nutrisi, hingga sosialisasi pemasaran hasil panen sawi pakcoy.
            </p>
            <img src="{{ $sets['proker_hidroponik_banner'] ? asset('storage/'.$sets['proker_hidroponik_banner']) : 'https://placehold.co/800x400' }}" class="img-fluid rounded shadow mt-3">
        
        @elseif($category->slug == 'proker-sekolah')
            <p class="lead">
                Program pengabdian di SDN Sidorahayu 1. 
                Fokus pada pembangunan karakter siswa melalui sosialisasi anti-bullying, literasi digital, dan fun learning.
            </p>
            <img src="{{ $sets['proker_sekolah_banner'] ? asset('storage/'.$sets['proker_sekolah_banner']) : 'https://placehold.co/800x400' }}" class="img-fluid rounded shadow mt-3">
        
        @else
            <p class="lead">Berikut adalah dokumentasi kegiatan kami untuk program {{ $category->name }}.</p>
        @endif
    </div>
</div>
    </div>
</div>

<div class="container pb-5">
    <h3 class="border-bottom pb-2 mb-4">Berita Kegiatan {{ $category->name }}</h3>
    
    <div class="row">
        @forelse($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="{{ $post->image_path ? asset('storage/'.$post->image_path) : 'https://placehold.co/400x250' }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <small class="text-muted">{{ $post->created_at->format('d M Y') }}</small>
                        <h5 class="card-title mt-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none text-dark">{{ $post->title }}</a>
                        </h5>
                        <p class="card-text text-muted small">{{ Str::limit(strip_tags($post->excerpt), 80) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada berita kegiatan untuk program ini.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>

@endsection