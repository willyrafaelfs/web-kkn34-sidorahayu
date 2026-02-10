@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Kelola Galeri & Media</h3>
        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">+ Tambah Media</a>
    </div>

    <div class="row">
        @foreach($galleries as $item)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 150px; overflow:hidden;">
                        @if($item->category == 'video')
                            <i class="bi bi-play-circle fs-1 text-danger"></i> @elseif($item->file_type == 'upload')
                            <img src="{{ asset('storage/'.$item->file_path) }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <i class="bi bi-link-45deg fs-1"></i>
                        @endif
                    </div>
                    
                    <div class="card-body">
                        <h6 class="card-title text-truncate">{{ $item->title }}</h6>
                        <span class="badge bg-info">{{ $item->category }}</span>
                        
                        <form action="{{ route('admin.galleries.destroy', $item->id) }}" method="POST" class="mt-2" onsubmit="return confirm('Hapus item ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger w-100">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection