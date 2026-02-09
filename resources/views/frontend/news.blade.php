@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1>Berita & Kegiatan Terkini</h1>

    <div class="mb-4">
        <input type="text" placeholder="Cari berita..." class="form-control">
    </div>

    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $post->image_path ? asset('storage/'.$post->image_path) : 'https://placehold.co/600x400' }}" class="card-img-top" alt="{{ $post->title }}">
                    
                    <div class="card-body">
                        <small class="text-muted">{{ $post->category->name }} | {{ $post->created_at->format('d M Y') }}</small>
                        <h5 class="card-title mt-2">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->excerpt }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection