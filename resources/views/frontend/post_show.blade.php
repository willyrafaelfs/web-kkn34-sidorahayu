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
            <h4 class="mb-4">Komentar ({{ $post->comments->count() }})</h4>

            <div class="mb-5">
                @forelse($post->comments as $comment)
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <img src="{{ $comment->user->avatar ?? 'https://ui-avatars.com/api/?name='.$comment->user->name }}" class="rounded-circle" width="50" height="50" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mt-0 mb-0 fw-bold">{{ $comment->user->name }}</h6>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            <p class="mt-1 mb-0">{{ $comment->body }}</p>
@if(Auth::check() && (Auth::id() == $comment->user_id || Auth::user()->role == 'admin'))
            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-link text-danger p-0 ms-2" style="font-size: 0.8rem; text-decoration: none;">
                    <small>Hapus</small>
                </button>
            </form>
        @endif
                        </div>
                    </div>
                @empty
                    <p class="text-muted fst-italic">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                @endforelse
            </div>

            <div class="card bg-light border-0">
                <div class="card-body p-4">
                    @auth
                        <h5 class="mb-3">Tulis Komentar</h5>
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            
                            <div class="mb-3">
                                <textarea name="body" class="form-control" rows="3" placeholder="Tulis tanggapan Anda di sini..." required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send-fill me-1"></i> Kirim Komentar
                            </button>
                        </form>
                    @else
                        <div class="text-center py-3">
                            <p class="mb-3">Ingin bergabung dalam diskusi?</p>
                            <a href="{{ route('google.login') }}" class="btn btn-outline-danger">
                                <i class="bi bi-google me-2"></i> Login dengan Google untuk Berkomentar
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
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