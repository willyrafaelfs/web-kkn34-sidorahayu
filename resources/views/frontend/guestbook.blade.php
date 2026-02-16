@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1>Sapa Kami</h1>
        <p class="text muted text-nowrap">Silakan tinggalkan pesan kesan untuk KKN Kelompok 34.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Isi Form
                </div>
                <div class="card-body">
                    @if(session('success_message'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i> {{ session('success_message') }}
                        </div>
                    @endif

                    <form action="{{ route('messages.store') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama" required>
                            <label for="name">Nama Lengkap</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                            <label for="email">Alamat Email (Tidak akan dipublikasikan)</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea name="message" class="form-control" placeholder="Pesan" id="message" style="height: 100px" required></textarea>
                            <label for="message">Pesan / Kesan / Saran</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Kirim Data</button>
                    </form>
                </div>
            </div>

            <div class="alert alert-info mt-4 text-center">
                <small>Terima kasih telah berkunjung. Pesan Anda akan tersimpan di arsip digital kami.</small>
            </div>
        </div>
    </div>
</div>
@endsection