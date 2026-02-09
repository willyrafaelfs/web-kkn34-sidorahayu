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
    Schema::create('teams', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama Lengkap
        $table->string('nim')->unique(); // NIM
        $table->string('faculty'); // Fakultas (Baru)
        $table->string('major'); // Jurusan/Prodi (Saran tambahan)
        $table->string('position'); // Jabatan (Ketua, Anggota, dsb)
        $table->string('instagram_link')->nullable(); // Link IG (Boleh kosong)
        $table->string('photo_path')->nullable(); // Foto Profil
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
