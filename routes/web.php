<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Import semua Controller di sini biar rapi
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController; // Controller Frontend
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Auth\GoogleController;

// Import Controller Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController; // Kita kasih nama alias biar gak bentrok

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- AUTHENTICATION ---
Auth::routes(['register' => false]); // Matikan register publik
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// --- HALAMAN PUBLIK ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil-desa', [HomeController::class, 'profilDesa'])->name('profil.desa');
Route::get('/lokasi', [HomeController::class, 'lokasi'])->name('lokasi');
Route::get('/tim', [HomeController::class, 'team'])->name('team');
Route::get('/galeri', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/buku-tamu', [HomeController::class, 'guestbook'])->name('guestbook');

// Berita & Proker
Route::get('/berita', [HomeController::class, 'news'])->name('news');
Route::get('/berita/{slug}', [HomeController::class, 'show'])->name('posts.show');
Route::get('/proker/{slug}', [HomeController::class, 'proker'])->name('proker.show');

// Kirim Pesan (Buku Tamu)
Route::post('/kirim-pesan', [MessageController::class, 'store'])->name('messages.store');

// --- FITUR MEMBER (Harus Login) ---
Route::middleware(['auth'])->group(function () {
    // Komentar (Frontend)
    Route::post('/komentar', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/komentar/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// --- HALAMAN ADMIN (Wajib Login & Role Admin) ---
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () { // Tambahkan middleware 'admin' jika sudah buat
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Resource Controller (Otomatis buat route index, create, store, edit, update, destroy)
    Route::resource('posts', PostController::class, ['as' => 'admin']);
    Route::resource('galleries', GalleryController::class, ['as' => 'admin']);
    Route::resource('teams', TeamController::class, ['as' => 'admin']);
    
    // Pesan Masuk
    Route::get('/pesan-masuk', [MessageController::class, 'indexAdmin'])->name('admin.messages.index');
    Route::delete('/pesan-masuk/{id}', [MessageController::class, 'destroy'])->name('admin.messages.destroy');

    // Manajemen Komentar (Admin)
    Route::get('/comments', [AdminCommentController::class, 'index'])->name('admin.comments.index');
    Route::delete('/comments/{id}', [AdminCommentController::class, 'destroy'])->name('admin.comments.destroy');

    // Pengaturan Tampilan
    Route::get('/settings', [SiteSettingController::class, 'index'])->name('admin.settings.index');
    Route::put('/settings', [SiteSettingController::class, 'update'])->name('admin.settings.update');
});