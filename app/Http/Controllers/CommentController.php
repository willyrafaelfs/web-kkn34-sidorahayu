<?php

namespace App\Http\Controllers; // <--- Perhatikan Namespace ini (Tanpa Admin)

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Fungsi Menyimpan Komentar Baru
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|min:3',
            'post_id' => 'required|exists:posts,id'
        ]);

        // Simpan ke Database
        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'body' => $request->body,
            // 'is_visible' => true // Hapus ini jika kolomnya tidak ada di database
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }

    // Fungsi Hapus Komentar (Milik Sendiri)
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Hanya boleh hapus jika dia pemilik komentar ATAU dia Admin
        if (Auth::id() !== $comment->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak berhak menghapus komentar ini.');
        }

        $comment->delete();
        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}