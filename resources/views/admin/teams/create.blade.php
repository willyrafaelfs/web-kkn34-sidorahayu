@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="card col-md-8 mx-auto shadow">
        <div class="card-header">Tambah Anggota Tim</div>
        <div class="card-body">
            <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Jabatan (Misal: Ketua, Sekretaris)</label>
                    <input type="text" name="position" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Fakultas</label>
                        <input type="text" name="faculty" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Jurusan</label>
                        <input type="text" name="major" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <label>Link Instagram (Opsional)</label>
                    <input type="url" name="instagram_link" class="form-control" placeholder="https://instagram.com/...">
                </div>
                <div class="mb-3">
                    <label>Foto Profil</label>
                    <input type="file" name="photo" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Simpan Anggota</button>
            </form>
        </div>
    </div>
</div>
@endsection