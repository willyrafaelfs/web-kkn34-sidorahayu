<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\GoogleController; // <--- Jangan lupa import ini

// ...

// RUTE LOGIN GOOGLE
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// --- HALAMAN PUBLIK (Bisa diakses siapa saja) ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tim', [HomeController::class, 'team'])->name('team');
Route::get('/berita', [HomeController::class, 'news'])->name('news');

// --- HALAMAN PUBLIK (Updated) ---
Route::get('/', [HomeController::class, 'index'])->name('home');

// Nanti tambah route detail berita, profil desa, dll di sini.
Route::get('/berita/{slug}', [HomeController::class, 'show'])->name('posts.show');

// Group TENTANG KAMI
Route::get('/profil-desa', [HomeController::class, 'profilDesa'])->name('profil.desa');
Route::get('/lokasi', [HomeController::class, 'lokasi'])->name('lokasi');
Route::get('/tim', [HomeController::class, 'team'])->name('team');

// Group PROGRAM KERJA (Kita pakai slug kategori biar dinamis)
Route::get('/proker/{slug}', [HomeController::class, 'proker'])->name('proker.show');

// Group PUBLIKASI
Route::get('/berita', [HomeController::class, 'news'])->name('news');
Route::get('/berita/{slug}', [HomeController::class, 'show'])->name('posts.show');
Route::get('/galeri', [HomeController::class, 'gallery'])->name('gallery');

// Group LAINNYA
Route::get('/buku-tamu', [HomeController::class, 'guestbook'])->name('guestbook');

// --- HALAMAN AUTH (Login/Register) ---
Auth::routes(['register' => false]); // Kita matikan register publik biar gak sembarang orang daftar jadi admin

// --- HALAMAN ADMIN (Hanya bisa diakses kalau sudah login & role admin) ---
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    // Dashboard Utama
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    // Nanti tambah route kelola berita, setting, dll di sini.
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class, ['as' => 'admin']);
    // Nanti tambah route Galeri, Tim, Pesan di sini...

    Route::redirect('/home', '/');
});