<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Pastikan ini ada agar bisa create data
    protected $guarded = []; 

    // 1. RELASI KE USER (Komentar milik User siapa?)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 2. RELASI KE POST (Komentar ini ada di Berita mana?)
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}