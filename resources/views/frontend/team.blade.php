@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Meet Our Team</h1>
        <p class="text-muted">Orang-orang hebat dibalik KKN Kelompok 34 Sidorahayu</p>
    </div>
    
    <div class="row justify-content-center">
        @foreach($teams as $team)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card h-100 border-0 shadow-sm text-center py-3">
                    <div class="card-body">
                        <img src="{{ $team->photo_path ? asset('storage/'.$team->photo_path) : 'https://placehold.co/150' }}" 
                             class="rounded-circle mb-3 shadow-sm" 
                             style="width: 120px; height: 120px; object-fit: cover;">
                        
                        <h5 class="card-title fw-bold mb-1">{{ $team->name }}</h5>
                        <p class="text-primary fw-bold small mb-1">{{ $team->position }}</p>
                        <p class="text-muted small mb-3">{{ $team->major }} - {{ $team->faculty }}</p>
                        
                        @if($team->instagram_link)
                            <a href="{{ $team->instagram_link }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                <i class="bi bi-instagram"></i> Follow
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection