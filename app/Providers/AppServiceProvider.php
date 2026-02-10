<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Kode 2 sudah masuk sini
use App\Models\SiteSetting;           // Kode 2 sudah masuk sini
use Illuminate\Support\Facades\Schema; // Tambahkan ini agar lebih rapi

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Cek apakah tabel sudah ada (mencegah error saat migration belum dijalankan)
        if (Schema::hasTable('site_settings')) {
            
            // 2. Ambil data settings (key => value)
            $global_settings = SiteSetting::all()->pluck('value', 'key');
        
            // 3. Share variabel $sets ke seluruh view Blade
            View::share('sets', $global_settings);        
        }

        // --- Jika Anda punya kode Paginator Bootstrap, letakkan di bawah sini ---
        // \Illuminate\Pagination\Paginator::useBootstrap();
    } // <-- Pastikan kurung penutup fungsi boot ada di sini
}
