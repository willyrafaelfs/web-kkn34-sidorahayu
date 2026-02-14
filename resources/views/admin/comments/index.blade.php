@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3>Kelola Komentar Berita</h3>
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Penulis</th>
                            <th>Komentar</th>
                            <th>Di Berita</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $comment->user->avatar ?? 'https://ui-avatars.com/api/?name='.$comment->user->name }}" class="rounded-circle me-2" width="30">
                                    <strong>{{ $comment->user->name }}</strong>
                                </div>
                            </td>
                            <td>{{ Str::limit($comment->body, 50) }}</td>
                            <td>
                                <a href="{{ route('posts.show', $comment->post->slug) }}" target="_blank" class="text-decoration-none">
                                    {{ Str::limit($comment->post->title, 30) }} <i class="bi bi-box-arrow-up-right small"></i>
                                </a>
                            </td>
                            <td>{{ $comment->created_at->format('d M Y') }}</td>
                            <td>
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Hapus komentar ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection