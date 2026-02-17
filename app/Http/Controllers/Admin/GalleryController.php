<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('is_published', true)->latest()->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required', // photo, video, poster
            'file_type' => 'required', // upload, link
            // Validasi dinamis: Kalau pilih upload, wajib ada file. Kalau link, wajib ada url.
            'file' => 'nullable|mimes:jpeg,png,jpg,mp4,mov,avi|max:204800', // Maks 200MB
            'link' => 'nullable|url',
        ]);

        $filePath = null;

        // Logika Simpan File
        if ($request->file_type == 'upload') {
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('galleries', 'public');
            }
        } else {
            // Kalau link youtube, kita ambil ID-nya aja atau simpan link utuh
            $filePath = $request->link;
        }

        Gallery::create([
            'title' => $request->title,
            'category' => $request->category,
            'file_type' => $request->file_type,
            'file_path' => $filePath,
            'description' => $request->description,
            'is_published' => true,
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan!');
    }

    public function destroy(Gallery $gallery)
    {
        // Hapus file fisik jika tipe-nya upload
        if ($gallery->file_type == 'upload' && $gallery->file_path) {
            Storage::disk('public')->delete($gallery->file_path);
        }
        
        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Item galeri dihapus.');
    }
}