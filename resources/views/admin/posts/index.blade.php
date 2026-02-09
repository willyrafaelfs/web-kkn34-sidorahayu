@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Berita & Artikel</h2>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Berita Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $key => $post)
                            <tr>
                                <td>{{ $posts->firstItem() + $key }}</td>
                                <td>
                                    <img src="{{ $post->image_path ? asset('storage/'.$post->image_path) : 'https://placehold.co/50' }}" width="50" height="50" class="object-fit-cover rounded">
                                </td>
                                <td>{{ $post->title }}</td>
                                <td><span class="badge bg-secondary">{{ $post->category->name }}</span></td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                                    
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada berita.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection