<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Message;
use App\Models\Visitor;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Berita
        $total_posts = Post::count();

        // 2. Hitung Pesan Masuk yang Belum Dibaca (Penting!)
        $unread_messages = Message::where('is_read', false)->count();

        // 3. Hitung Pengunjung Hari Ini
        $today_visitors = Visitor::whereDate('date', today())->count();

        // 4. Hitung Total Pengunjung (Semua Waktu)
        $total_visitors = Visitor::count();

        // Kirim data ke view 'admin.dashboard'
        return view('admin.dashboard', compact('total_posts', 'unread_messages', 'today_visitors', 'total_visitors'));
    }
}