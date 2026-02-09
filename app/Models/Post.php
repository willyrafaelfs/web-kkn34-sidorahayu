<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'user_id', 'title', 'slug', 
        'excerpt', 'body', 'image_path', 'published_at'
    ];

    // Post milik satu Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Post ditulis oleh satu User (Admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Post punya banyak Komentar
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}