@extends('layouts.app')

@section('content')
<style>
    /* Kunci agar 5 card tidak mengecil: Perlebar container utama */
    .container-wide {
        max-width: 1440px; 
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Penyesuaian responsif untuk teks agar tetap rapi */
    .card-text-fixed {
        font-size: 0.85rem;
        min-height: 40px; /* Menjaga tinggi teks tetap sejajar */
    }
</style>

<div class="container-wide py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Meet Our Team</h1>
        <p class="text-muted">Orang-orang hebat dibalik KKN Kelompok 34 Sidorahayu</p>
    </div>
    
    <!-- 
        row-cols-1: 1 baris di HP
        row-cols-md-3: 3 baris di Tablet
        row-cols-lg-5: 5 baris di Desktop/Laptop
        g-4: Memberi jarak antar card
    -->
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-4 justify-content-center">
        @foreach($teams as $team)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm text-center py-4">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img src="{{ $team->photo_path ? asset('storage/'.$team->photo_path) : 'https://placehold.co' }}" 
                             class="rounded-circle mb-3 shadow-sm" 
                             style="width: 110px; height: 110px; object-fit: cover;">
                        
                        <h5 class="card-title fw-bold mb-1 fs-6">{{ $team->name }}</h5>
                        <p class="text-primary fw-bold small mb-1">{{ $team->position }}</p>
                        <p class="text-muted card-text-fixed mb-3">
                            {{ $team->major }} <br> {{ $team->faculty }}
                        </p>
                        
                        @if($team->instagram_link)
                            <a href="{{ $team->instagram_link }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-3 mt-auto">
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
