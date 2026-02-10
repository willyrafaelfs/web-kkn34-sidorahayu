<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Team;
use App\Models\Gallery;
use App\Models\SiteSetting;
use App\Models\Message;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. BUAT AKUN ADMIN (PENTING!)
        // Passwordnya: password123
        $admin = User::create([
            'name' => 'Admin KKN 34',
            'email' => 'admin@kkn34.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'avatar' => null,
        ]);

        // 2. BUAT KATEGORI BERITA
        $catHidroponik = Category::create(['name' => 'Program Hidroponik', 'slug' => 'proker-hidroponik']);
        $catSekolah = Category::create(['name' => 'Program Sekolah & Edukasi', 'slug' => 'proker-sekolah']);
        $catDesa = Category::create(['name' => 'Kegiatan Desa', 'slug' => 'kegiatan-desa']);

        // 3. BUAT CONTOH BERITA (DUMMY)
        Post::create([
            'category_id' => $catHidroponik->id,
            'user_id' => $admin->id,
            'title' => 'Panen Perdana Sawi Pakcoy Hidroponik',
            'slug' => 'panen-perdana-sawi-pakcoy-hidroponik',
            'excerpt' => 'Kegiatan panen raya bersama warga desa Sidorahayu berlangsung meriah.',
            'body' => '<p>Hari ini tim KKN 34 melakukan panen perdana sistem hidroponik yang telah dibangun selama 3 minggu terakhir. Hasil panen dibagikan kepada warga sekitar.</p>',
            'image_path' => 'berita1.jpg', // Nanti kita ganti upload beneran
            'published_at' => now(),
        ]);

        Post::create([
            'category_id' => $catSekolah->id,
            'user_id' => $admin->id,
            'title' => 'Sosialisasi Anti-Bullying di SDN Sidorahayu 1',
            'slug' => 'sosialisasi-anti-bullying-sdn-sidorahayu-1',
            'excerpt' => 'Mahasiswa KKN memberikan edukasi pentingnya pertemanan sehat sejak dini.',
            'body' => '<p>Antusiasme siswa SDN Sidorahayu 1 sangat tinggi saat materi disampaikan. Kami menggunakan metode permainan agar siswa mudah paham.</p>',
            'image_path' => 'berita2.jpg',
            'published_at' => now(),
        ]);

        // 4. BUAT DATA TIM (Contoh)
        Team::create([
            'name' => 'Budi Santoso',
            'nim' => '20231001',
            'faculty' => 'Fakultas Ilmu Komputer',
            'major' => 'Sistem Informasi',
            'position' => 'Ketua Kelompok',
            'instagram_link' => 'https://instagram.com/budisantoso',
            'photo_path' => 'team1.jpg',
        ]);

        Team::create([
            'name' => 'Siti Aminah',
            'nim' => '20231002',
            'faculty' => 'Fakultas Ekonomi',
            'major' => 'Manajemen',
            'position' => 'Sekretaris',
            'instagram_link' => 'https://instagram.com/sitiaminah',
            'photo_path' => 'team2.jpg',
        ]);

        // 5. BUAT SETTING WEBSITE DEFAULT
        SiteSetting::create(['key' => 'site_title', 'value' => 'KKN 34 Sidorahayu', 'type' => 'text']);
        SiteSetting::create(['key' => 'footer_text', 'value' => '© 2026 KKN Kelompok 34 - Mengabdi dengan Hati.', 'type' => 'text']);
        SiteSetting::create(['key' => 'instagram_url', 'value' => 'https://instagram.com/kkn34sidorahayu', 'type' => 'text']);
        SiteSetting::create(['key' => 'youtube_url', 'value' => 'https://youtube.com/@kkn34', 'type' => 'text']);

        // 1. PENGATURAN LOGO
SiteSetting::create(['key' => 'logo_header_1', 'value' => null, 'type' => 'image']); // Logo Univ
SiteSetting::create(['key' => 'logo_header_2', 'value' => null, 'type' => 'image']); // Logo Diktisaintek
SiteSetting::create(['key' => 'logo_header_3', 'value' => null, 'type' => 'image']); // Logo Kampus Merdeka
SiteSetting::create(['key' => 'logo_footer',   'value' => null, 'type' => 'image']); // Logo Kelompok

// 2. PENGATURAN HERO (SLIDER DEPAN)
SiteSetting::create(['key' => 'hero_image', 'value' => null, 'type' => 'image']); 
SiteSetting::create(['key' => 'hero_video', 'value' => null, 'type' => 'file']); // Bisa upload video mp4

// 3. PENGATURAN GAMBAR PROKER (Thumbnail & Banner)
SiteSetting::create(['key' => 'proker_hidroponik_thumb',  'value' => null, 'type' => 'image']); // 400x400
SiteSetting::create(['key' => 'proker_sekolah_thumb',     'value' => null, 'type' => 'image']); // 400x400
SiteSetting::create(['key' => 'proker_hidroponik_banner', 'value' => null, 'type' => 'image']); // 800x400
SiteSetting::create(['key' => 'proker_sekolah_banner',    'value' => null, 'type' => 'image']); // 800x400

        // 6. BUAT CONTOH GALERI
        Gallery::create([
            'title' => 'After Movie KKN',
            'category' => 'video',
            'file_type' => 'link', // Ini Link Youtube
            'file_path' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 
            'description' => 'Video dokumentasi lengkap kegiatan kami selama 30 hari.',
            'is_published' => true,
        ]);
        
        Gallery::create([
            'title' => 'Poster Proker Utama',
            'category' => 'poster',
            'file_type' => 'upload',
            'file_path' => 'poster1.jpg',
            'description' => 'Infografis alur pembuatan hidroponik.',
            'is_published' => true,
        ]);

        // 7. CONTOH PESAN MASUK
        Message::create([
            'name' => 'Pak RT 05',
            'email' => 'pakrt@gmail.com',
            'subject' => 'Ucapan Terima Kasih',
            'message' => 'Terima kasih mas mbak KKN sudah bantu bersihin musholla kemarin.',
            'is_read' => false,
        ]);
    }
}