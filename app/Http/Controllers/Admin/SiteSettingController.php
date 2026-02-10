<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index()
    {
        // Ambil semua setting, jadikan array biar gampang dipanggil di view
        // Hasilnya jadi: ['logo_header_1' => 'path/gambar.jpg', ...]
        $settings = SiteSetting::all()->pluck('value', 'key');
        
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Kita loop semua input yang dikirim
        $inputs = $request->all();

        foreach ($inputs as $key => $value) {
            // Cek apakah input ini adalah File Gambar/Video?
            if ($request->hasFile($key)) {
                
                // 1. Ambil setting lama di database
                $setting = SiteSetting::where('key', $key)->first();
                
                if($setting) {
                    // 2. Hapus file lama jika ada
                    if ($setting->value) {
                        Storage::disk('public')->delete($setting->value);
                    }

                    // 3. Upload file baru
                    $path = $request->file($key)->store('settings', 'public');
                    
                    // 4. Update database
                    $setting->update(['value' => $path]);
                }
            }
        }

        return back()->with('success', 'Pengaturan tampilan berhasil diperbarui!');
    }
}