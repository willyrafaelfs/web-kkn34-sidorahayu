@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Kelola Tim KKN</h3>
        <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">+ Tambah Anggota</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama & NIM</th>
                        <th>Jabatan</th>
                        <th>Fakultas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $team)
                    <tr>
                        <td>
                            <img src="{{ $team->photo_path ? asset('storage/'.$team->photo_path) : 'https://placehold.co/50' }}" width="50" class="rounded-circle">
                        </td>
                        <td>
                            <strong>{{ $team->name }}</strong><br>
                            <small class="text-muted">{{ $team->nim }}</small>
                        </td>
                        <td><span class="badge bg-info">{{ $team->position }}</span></td>
                        <td>{{ $team->faculty }}<br><small>{{ $team->major }}</small></td>
                        <td>
                            <a href="{{ route('admin.teams.edit', $team->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection