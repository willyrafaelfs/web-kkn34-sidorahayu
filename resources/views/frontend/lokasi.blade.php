@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1>Lokasi KKN & Posko</h1>
        <p>Posko KKN Kelompok 34 berada di Dusun Tulus Ayu.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-1">
            <div class="ratio ratio-21x9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3950.888396383423!2d112.6008333!3d-8.010444399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zOMKwMDAnMzcuNiJTIDExMsKwMzYnMDMuMCJF!5e0!3m2!1sen!2sid!4v1770724764049!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4 text-center">
            <i class="bi bi-geo-alt fs-1 text-danger"></i>
            <h5 class="mt-3">Alamat Posko</h5>
            <p>Dusun Tulus Ayu, RT 05 RW 02<br>Desa Sidorahayu, Wagir.</p>
        </div>
        <div class="col-md-4 text-center">
            <i class="bi bi-map fs-1 text-primary"></i>
            <h5 class="mt-3">Jarak dari Kampus</h5>
            <p>± 7 Kilometer<br>(Sekitar 15 menit perjalanan)</p>
        </div>
        <div class="col-md-4 text-center">
            <i class="bi bi-pin-map fs-1 text-success"></i>
            <h5 class="mt-3">Program Utama</h5>
            <p>Tanaman Hidroponik<br>Sosialisasi di SDN 03 Sidorahayu</p>
        </div>
    </div>
</div>
@endsection