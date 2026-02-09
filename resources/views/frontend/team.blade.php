@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h1 class="mb-5">Tim KKN Kelompok 34</h1>
    
    <div class="row justify-content-center">
        @foreach($teams as $team)
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="{{ $team->photo_path ? asset('storage/'.$team->photo_path) : 'https://placehold.co/300x300' }}" class="card-img-top rounded-circle mx-auto mt-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $team->name }}</h5>
                        <p class="text-primary mb-1">{{ $team->position }}</p>
                        <small class="text-muted">{{ $team->faculty }} - {{ $team->major }}</small>
                        <div class="mt-3">
                            @if($team->instagram_link)
                                <a href="{{ $team->instagram_link }}" target="_blank" class="btn btn-outline-danger btn-sm">Instagram</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection