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
                <p>Desa Sidorahayu adalah salah satu desa di wilayah Kecamatan Wagir, nama desa Sidorahayu berasal dari kata dalam bahasa Jawa: Sido (Jadi/Terlaksana) dan Rahayu (Selamat/Sejahtera/Tenteram). Nama ini mencerminkan harapan agar masyarakat desa selalu dalam keadaan selamat dan sejahtera. Desa ini berada di ketinggian sekitar 450 meter di atas permukaan laut. Secara administratif, desa ini terbagi menjadi lima dusun, di antaranya Dusun Tulusayu, Dusun Bunder, Dusun Wonosari, dan Dusun Tembung.</p>
                <p><i>(Data mengenai profil desa ini diperoleh melalui mesin pencari Google)</i></p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body">
                            <h4>Visi</h4>
                            <p>"Mewujudkan Desa Sidorahayu yang mandiri, agamis, sejahtera, dan profesional dalam pelayanan”</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body">
                            <h4>Misi</h4>
                            <ul>
                                <li>Pelayanan Profesional.</li> 
                                <li>Kemandirian Ekonomi.</li>
                                <li>Keharmonisan Beragama.</li>
                                <li>Pembangunan Sarana</li>
                                <li>Pemberdayaan masyarakat.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection