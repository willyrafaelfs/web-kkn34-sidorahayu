<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // 1. Mengarahkan User ke Halaman Login Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Menangani User yang Kembali dari Google (Callback)
    public function handleGoogleCallback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->user();
            
            // Cek apakah user ini sudah pernah login sebelumnya?
            $finduser = User::where('google_id', $googleUser->id)->orWhere('email', $googleUser->email)->first();

            if($finduser){
                // Jika SUDAH ADA, langsung login
                Auth::login($finduser);
                
                // Update Google ID & Avatar jika belum ada
                $finduser->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                ]);

                return redirect('/'); // Kembali ke Beranda
            }else{
                // Jika BELUM ADA, buat akun baru otomatis
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id'=> $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'role' => 'user', // Pastikan role-nya user biasa
                    'password' => Hash::make('password_acak_123') // Password dummy (karena login pakai Google)
                ]);

                Auth::login($newUser);
                return redirect('/');
            }

        } catch (\Exception $e) {
            // Kalau gagal (misal batal login), kembalikan ke login biasa
            return redirect('/login')->with('error', 'Login Google Gagal, silakan coba lagi.');
        }
    }
}