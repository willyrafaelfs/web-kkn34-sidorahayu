@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h1 class="fw-bold">Profil Desa Sidorahayu</h1>
                <p class="text-muted">Kecamatan Wagir, Kabupaten Malang, Jawa Timur</p>
                <img src="{{ isset($sets['profil_desa_image']) && $sets['profil_desa_image'] ? asset('storage/'.$sets['profil_desa_image']) : 'https://placehold.co/800x400' }}" class="img-fluid rounded shadow-sm mt-3" alt="Kantor Desa">
            </div>

            <div class="mb-5">
                <h3>Sejarah Singkat</h3>
                <p>Desa Sidorahayu adalah salah satu desa di wilayah Kecamatan Wagir yang memiliki potensi pertanian yang besar...</p>
                <p><i>(king)</i></p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body">
                            <h4>Visi</h4>
                            <p>“Terwujudnya Desa Sidorahayu yang Maju, Mandiri, dan Sejahtera.”</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body">
                            <h4>Misi</h4>
                            <ul>
                                <li>Meningkatkan pelayanan publik.</li>
                                <li>Mengembangkan potensi pertanian hidroponik.</li>
                                <li>Meningkatkan kualitas sumber daya manusia.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection