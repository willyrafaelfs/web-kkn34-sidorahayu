<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    // Simpan pesan dari warga (Frontend)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        Message::create($request->all());

        return back()->with('success_message', 'Terima kasih! Pesan Anda telah terkirim.');
    }

    // Tampilkan pesan di Admin (Backend)
    // Sebaiknya ini dipisah ke AdminController, tapi disini juga gapapa biar cepat
    public function indexAdmin()
    {
        $messages = Message::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }
    
    // Hapus pesan
    public function destroy($id)
    {
        Message::destroy($id);
        return back()->with('success', 'Pesan dihapus.');
    }
}