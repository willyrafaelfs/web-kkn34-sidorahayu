<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi: Komentar tidak boleh kosong
        $request->validate([
            'body' => 'required|min:3',
            'post_id' => 'required|exists:posts,id'
        ]);

        // 2. Simpan ke Database
        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(), // Ambil ID user yang sedang login
            'body' => $request->body,
            'is_visible' => true // Langsung tampil (bisa diubah jadi false kalau mau moderasi)
        ]);

        // 3. Kembali ke halaman berita dengan pesan sukses
        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}