@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="card col-md-8 mx-auto shadow">
        <div class="card-header">Edit Anggota Tim: {{ $team->name }}</div>
        <div class="card-body">
            <!-- Action diarahkan ke route update dengan menyertakan ID -->
            <form action="{{ route('admin.teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Wajib untuk proses update di Laravel -->
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ $team->name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" value="{{ $team->nim }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Jabatan (Misal: Ketua, Sekretaris)</label>
                    <input type="text" name="position" class="form-control" value="{{ $team->position }}" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Fakultas</label>
                        <input type="text" name="faculty" class="form-control" value="{{ $team->faculty }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Jurusan</label>
                        <input type="text" name="major" class="form-control" value="{{ $team->major }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label>Link Instagram (Opsional)</label>
                    <input type="url" name="instagram_link" class="form-control" value="{{ $team->instagram_link }}" placeholder="https://instagram.com/...">
                </div>
                <div class="mb-3">
                    <label>Foto Profil</label>
                    @if($team->photo)
                        <div class="mb-2">
                            <small class="text-muted">Foto saat ini:</small><br>
                            <img src="{{ asset('storage/' . $team->photo) }}" width="100" class="img-thumbnail">
                        </div>
                    @endif
                    <input type="file" name="photo" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Anggota</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
