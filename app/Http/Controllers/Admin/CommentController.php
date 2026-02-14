<?php

namespace App\Http\Controllers\Admin; // <--- Perhatikan Namespace ini beda!

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Menampilkan semua komentar di Dashboard Admin
    public function index()
    {
        // Ambil komentar beserta data user dan post-nya
        $comments = Comment::with(['user', 'post'])->latest()->get();
        return view('admin.comments.index', compact('comments'));
    }

    // Menghapus komentar dari Dashboard Admin
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back()->with('success', 'Komentar berhasil dihapus oleh Admin.');
    }
}