<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
        
        // Relasi ke Tabel Posts (Berita)
        // onDelete('cascade') artinya: Jika berita dihapus admin, semua komentarnya otomatis ikut terhapus.
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
        
        // Relasi ke Tabel Users (Siapa yang komentar)
        // onDelete('cascade') artinya: Jika user dihapus, komentarnya hilang.
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
        // Isi komentar
            $table->text('body');
        
        // Status Tampil (Default: True/Tampil)
        // Fitur jaga-jaga: Kalau ada komentar kasar, Admin bisa ubah jadi false (hidden) tanpa menghapus datanya.
            $table->boolean('is_visible')->default(true);
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
