<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('bot_replies', function (Blueprint $table) {
            $table->id();
            // Keyword atau angka yang diketik user, e.g., '1', '11'
            $table->string('keyword')->unique(); 
            // Judul singkat untuk menu, e.g., "Info Surat"
            $table->string('title'); 
            // Teks balasan lengkap dari bot
            $table->text('response_text'); 
            // Tipe balasan: 'menu' (jika masih ada pilihan) atau 'info' (jawaban akhir)
            $table->enum('type', ['menu', 'info'])->default('info'); 
            $table->timestamps();
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_replies');
    }
};
