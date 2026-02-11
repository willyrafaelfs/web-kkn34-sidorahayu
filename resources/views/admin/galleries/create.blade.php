@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card col-md-8 mx-auto shadow">
        <div class="card-header bg-white">
            <h4>Tambah Media Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Judul Media</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Kategori</label>
                        <select name="category" class="form-select">
                            <option value="photo">Foto Dokumentasi</option>
                            <option value="video">Video (YouTube)</option>
                            <option value="poster">Poster/Infografis</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tipe Sumber</label>
                        <select name="file_type" id="file_type" class="form-select">
                            <option value="upload">Upload File (Dari Laptop)</option>
                            <option value="link">Link Eksternal (YouTube/GDrive)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3" id="input_upload">
                    <label>Pilih File Foto/Video</label>
                    <input type="file" name="file" class="form-control" accept="image/*,video/mp4,video/quicktime,video/x-msvideo">
                </div>

                <div class="mb-3 d-none" id="input_link">
                    <label>Masukkan Link URL (Contoh: https://youtube.com/...)</label>
                    <input type="url" name="link" class="form-control" placeholder="https://...">
                </div>

                <div class="mb-3">
                    <label>Keterangan (Opsional)</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan Media</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('file_type').addEventListener('change', function() {
        var type = this.value;
        if(type === 'upload') {
            document.getElementById('input_upload').classList.remove('d-none');
            document.getElementById('input_link').classList.add('d-none');
        } else {
            document.getElementById('input_upload').classList.add('d-none');
            document.getElementById('input_link').classList.remove('d-none');
        }
    });
</script>
@endpush
@endsection