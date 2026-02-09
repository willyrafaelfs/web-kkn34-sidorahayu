@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dashboard Admin</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-success">+ Tulis Berita Baru</a>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h3>{{ $total_posts }}</h3>
                    <p>Total Artikel</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h3>{{ $unread_messages }}</h3>
                    <p>Pesan Baru</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h3>{{ $today_visitors }}</h3>
                    <p>Pengunjung Hari Ini</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Manajemen Berita</div>
        <div class="card-body">
            <p>Untuk mengelola berita lengkap, silakan ke menu <a href="{{ route('admin.posts.index') }}">Daftar Berita</a>.</p>
        </div>
    </div>
</div>
@endsection