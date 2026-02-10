@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3>Pengaturan Tampilan Website</h3>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white">Logo & Identitas</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Logo Header 1 (Univ)</label>
                            <input type="file" name="logo_header_1" class="form-control mb-2">
                            @if($settings['logo_header_1'])
                                <img src="{{ asset('storage/'.$settings['logo_header_1']) }}" height="40">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label>Logo Header 2 (Diktisaintek)</label>
                            <input type="file" name="logo_header_2" class="form-control mb-2">
                            @if($settings['logo_header_2'])
                                <img src="{{ asset('storage/'.$settings['logo_header_2']) }}" height="40">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label>Logo Header 3 (Kampus Merdeka)</label>
                            <input type="file" name="logo_header_3" class="form-control mb-2">
                            @if($settings['logo_header_3'])
                                <img src="{{ asset('storage/'.$settings['logo_header_3']) }}" height="40">
                            @endif
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label>Logo Footer (Kelompok)</label>
                            <input type="file" name="logo_footer" class="form-control mb-2">
                            @if($settings['logo_footer'])
                                <img src="{{ asset('storage/'.$settings['logo_footer']) }}" height="60">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-info text-white">Halaman Depan (Hero)</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Gambar Background Utama</label>
                            <input type="file" name="hero_image" class="form-control mb-2">
                            @if($settings['hero_image'])
                                <img src="{{ asset('storage/'.$settings['hero_image']) }}" class="img-fluid rounded" style="max-height: 100px">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label>Video Background (MP4)</label>
                            <input type="file" name="hero_video" class="form-control mb-2" accept="video/mp4">
                            @if($settings['hero_video'])
                                <small class="text-success">Video tersimpan.</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">Gambar Program Kerja</div>
                    <div class="card-body row">
                        <div class="col-md-6 border-end">
                            <h5>Program Hidroponik</h5>
                            <div class="mb-3">
                                <label>Thumbnail Depan (400x400)</label>
                                <input type="file" name="proker_hidroponik_thumb" class="form-control">
                                @if($settings['proker_hidroponik_thumb'])
                                    <img src="{{ asset('storage/'.$settings['proker_hidroponik_thumb']) }}" width="100">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label>Banner Halaman Detail (800x400)</label>
                                <input type="file" name="proker_hidroponik_banner" class="form-control">
                                @if($settings['proker_hidroponik_banner'])
                                    <img src="{{ asset('storage/'.$settings['proker_hidroponik_banner']) }}" width="150">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h5>Program Sekolah</h5>
                            <div class="mb-3">
                                <label>Thumbnail Depan (400x400)</label>
                                <input type="file" name="proker_sekolah_thumb" class="form-control">
                                @if($settings['proker_sekolah_thumb'])
                                    <img src="{{ asset('storage/'.$settings['proker_sekolah_thumb']) }}" width="100">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label>Banner Halaman Detail (800x400)</label>
                                <input type="file" name="proker_sekolah_banner" class="form-control">
                                @if($settings['proker_sekolah_banner'])
                                    <img src="{{ asset('storage/'.$settings['proker_sekolah_banner']) }}" width="150">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100">Simpan Semua Perubahan</button>
    </form>
</div>
@endsection