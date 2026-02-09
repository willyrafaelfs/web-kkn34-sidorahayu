<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi oleh sistem (Mass Assignable)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id', // Tambahan: ID dari Google
        'role',      // Tambahan: 'admin' atau 'user'
        'avatar',    // Tambahan: Foto profil dari Google
    ];

    /**
     * Kolom yang disembunyikan saat data dikirim (Security)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tipe data otomatis (Casting)
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- RELASI (Hubungan antar Tabel) ---

    // Satu User (Admin) bisa menulis banyak Berita
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Satu User (Pengunjung) bisa menulis banyak Komentar
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}