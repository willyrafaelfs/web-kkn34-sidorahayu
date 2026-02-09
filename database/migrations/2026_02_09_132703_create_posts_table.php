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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories'); // Relasi ke kategori
            $table->foreignId('user_id')->constrained('users'); // Relasi ke admin
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt'); // Ringkasan berita
            $table->longText('body'); // Isi berita lengkap (bisa teks panjang)
            $table->string('image_path')->nullable(); // Thumbnail berita
            $table->timestamp('published_at')->nullable(); // Tanggal terbit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
