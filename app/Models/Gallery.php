<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category', 'file_type', 'file_path', 'description', 'is_published'];

    // ACCESOR BARU: Otomatis generate link Youtube Embed
    public function getYoutubeEmbedAttribute()
    {
        $url = $this->file_path;
        
        // Cek link pendek (youtu.be)
        if (strpos($url, 'youtu.be') !== false) {
            $id = substr(parse_url($url, PHP_URL_PATH), 1);
            return 'https://www.youtube.com/embed/' . $id;
        }
        
        // Cek link biasa (youtube.com/watch?v=...)
        if (strpos($url, 'watch?v=') !== false) {
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            return 'https://www.youtube.com/embed/' . ($params['v'] ?? '');
        }

        // Kalau sudah link embed atau format lain, kembalikan aslinya
        return $url;
    }
}