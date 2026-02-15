<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category', 'file_type', 'file_path', 'description', 'is_published'];

    // Ambil YouTube ID dari berbagai format
    public function getYoutubeIdAttribute()
    {
        $url = $this->file_path;
        if (!$url) return null;

        $url = trim($url);

        // Jika sudah hanya ID
        if (preg_match('/^[A-Za-z0-9_-]{11}$/', $url)) {
            return $url;
        }

        // youtu.be/ID
        if (preg_match('/youtu\.be\/([A-Za-z0-9_-]{11})/', $url, $m)) {
            return $m[1];
        }

        // youtube.com/watch?v=ID
        if (preg_match('/v=([A-Za-z0-9_-]{11})/', $url, $m)) {
            return $m[1];
        }

        // embed/ID
        if (preg_match('/embed\/([A-Za-z0-9_-]{11})/', $url, $m)) {
            return $m[1];
        }

        // fallback: cari pola ID di string
        if (preg_match('/([A-Za-z0-9_-]{11})/', $url, $m)) {
            return $m[1];
        }

        return null;
    }

    // URL embed yang aman untuk iframe
    public function getYoutubeEmbedAttribute()
    {
        $id = $this->youtube_id;
        return $id ? "https://www.youtube.com/embed/{$id}" : $this->file_path;
    }

    // URL watch (buka di tab baru)
    public function getYoutubeWatchAttribute()
    {
        $id = $this->youtube_id;
        return $id ? "https://www.youtube.com/watch?v={$id}" : $this->file_path;
    }

    // Thumbnail YouTube
    public function getYoutubeThumbnailAttribute()
    {
        $id = $this->youtube_id;
        return $id ? "https://img.youtube.com/vi/{$id}/hqdefault.jpg" : null;
    }
}