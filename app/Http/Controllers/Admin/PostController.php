<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str; // Untuk membuat slug (judul-menjadi-seperti-ini)
use Illuminate\Support\Facades\Storage; // Untuk hapus foto lama

class PostController extends Controller
{
    // MENAMPILKAN DAFTAR BERITA
    public function index()
    {
        // Ambil berita terbaru, 10 per halaman
        $posts = Post::with('category')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    // MENAMPILKAN FORM TAMBAH BERITA
    public function create()
    {
        $categories = Category::all(); // Kirim kategori buat pilihan di form
        return view('admin.posts.create', compact('categories'));
    }

    // MENYIMPAN BERITA BARU KE DATABASE
    public function store(Request $request)
    {
        // 1. Validasi Input (Wajib diisi)
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        // 2. Handle Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan ke folder 'public/storage/posts'
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        // 3. Simpan ke Database
        Post::create([
            'user_id' => auth()->id(), // Ambil ID admin yang sedang login
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title), // Otomatis bikin slug
            'excerpt' => Str::limit(strip_tags($request->body), 150), // Ambil 150 huruf pertama buat ringkasan
            'body' => $request->body,
            'image_path' => $imagePath,
            'published_at' => now(),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    // MENAMPILKAN FORM EDIT
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    // UPDATE BERITA YANG SUDAH ADA
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|max:10240',
        ]);

        // Cek apakah admin upload gambar baru?
        if ($request->hasFile('image')) {
            // Hapus gambar lama biar server gak penuh
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            // Simpan gambar baru
            $post->image_path = $request->file('image')->store('posts', 'public');
        }

        // Update data lainnya
        $post->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => Str::limit(strip_tags($request->body), 150),
            'body' => $request->body,
            // image_path otomatis terupdate di atas kalau ada file baru
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil diperbarui!');
    }

    // HAPUS BERITA
    public function destroy(Post $post)
    {
        // Hapus file gambarnya dulu
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }

        // Hapus datanya dari database
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Berita telah dihapus.');
    }
}