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
    Schema::create('galleries', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Judul (Misal: "After Movie KKN 34")
        
        // Kategori: Membedakan mana Foto Biasa, Poster, atau Video
        $table->enum('category', ['photo', 'video', 'poster']); 
        
        // Tipe File: Apakah file ini di-upload ke server atau cuma Link?
        $table->enum('file_type', ['upload', 'link']); 
        
        // Isinya: Bisa berupa nama file ("foto1.jpg") ATAU URL ("https://youtube.com/...")
        $table->text('file_path'); 
        
        $table->text('description')->nullable(); // Deskripsi singkat
        $table->boolean('is_published')->default(true); // Mau ditampilkan atau disembunyikan?
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
