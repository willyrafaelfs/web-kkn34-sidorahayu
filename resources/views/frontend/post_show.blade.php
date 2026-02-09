@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <img src="{{ $post->image_path ? asset('storage/'.$post->image_path) : 'https://placehold.co/800x400' }}" class="img-fluid mb-3 w-100">
            
            <h1>{{ $post->title }}</h1>
            <p class="text-muted">
                Oleh {{ $post->user->name }} | {{ $post->created_at->format('d F Y') }} | Kategori: {{ $post->category->name }}
            </p>
            <hr>

            <div class="content">
                {!! $post->body !!}
            </div>

            <hr class="my-5">
            <h4>Komentar</h4>
            <p>Fitur komentar akan segera hadir.</p>
        </div>

        <div class="col-lg-4">
            <h4>Berita Terkait</h4>
            <ul class="list-group">
                @foreach($related_posts as $related)
                    <li class="list-group-item">
                        <a href="{{ route('posts.show', $related->slug) }}" class="text-decoration-none">
                            {{ $related->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection