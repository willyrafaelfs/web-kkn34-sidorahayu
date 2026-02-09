<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Team;
use App\Models\Gallery;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil 3 Berita Terbaru
        $latest_posts = Post::with('category')->latest()->take(3)->get();
        
        // 2. Ambil Data Proker (Hidroponik & Sosialisasi) untuk di-highlight
        // Kita asumsikan kategori ID 1 & 2 adalah proker utama (sesuai seeder)
        $proker_utama = Post::whereIn('category_id', [1, 2])->latest()->take(2)->get();

        // 3. Ambil Galeri (Video & Poster)
        $galleries = Gallery::where('is_published', true)->get();

        // 4. Kirim semua data ke tampilan 'welcome'
        return view('welcome', compact('latest_posts', 'proker_utama', 'galleries'));
    }

    public function team()
    {
        $teams = Team::all();
        return view('frontend.team', compact('teams'));
    }

    public function news()
    {
        $posts = Post::with('category')->latest()->paginate(9); // 9 berita per halaman
        return view('frontend.news', compact('posts'));
    }

    public function show($slug)
    {
    // Cari berita berdasarkan slug, kalau gak ada tampilkan 404
    $post = Post::where('slug', $slug)->firstOrFail();
    
    // Ambil berita lain buat rekomendasi di bawah
    $related_posts = Post::where('category_id', $post->category_id)
                        ->where('id', '!=', $post->id)
                        ->take(3)->get();

    return view('frontend.post_show', compact('post', 'related_posts'));
    }

    // HALAMAN PROFIL DESA
    public function profilDesa()
    {
        return view('frontend.profil_desa'); // Kamu perlu buat file view kosongnya nanti
    }

    // HALAMAN LOKASI
    public function lokasi()
    {
        return view('frontend.lokasi'); // Kamu perlu buat file view kosongnya nanti
    }

    // HALAMAN PROKER (Menampilkan berita berdasarkan kategori)
    public function proker($slug)
    {
        // Cari kategori berdasarkan slug (misal: 'hidroponik')
        $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
        
        // Ambil semua berita yang kategorinya ini
        $posts = \App\Models\Post::where('category_id', $category->id)->latest()->paginate(9);
        
        return view('frontend.news', compact('posts', 'category')); // Kita pakai tampilan berita aja biar hemat waktu
    }

    // HALAMAN GALERI
    public function gallery()
    {
        $galleries = \App\Models\Gallery::where('is_published', true)->latest()->get();
        return view('frontend.gallery', compact('galleries'));
    }

    // HALAMAN BUKU TAMU
    public function guestbook()
    {
        // Ambil komentar publik atau buat view khusus form pesan
        return view('frontend.guestbook');
    }
}