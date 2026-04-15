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
        // Schema::create('non_b3_logbooks', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        Schema::create('non_b3_logbooks', function (Blueprint $table) {
            $table->id();

            // Kategori
            $table->enum('kategori', ['Organik', 'Domestik']);

            // Data Utama
            $table->date('tanggal');
            $table->string('jenis_limbah');

            // Pengukuran (Universal untuk Berat/Volume)
            $table->decimal('jumlah', 8, 2);
            $table->string('satuan')->default('kg'); // kg atau m3

            // Kolom Spesifik (Dibuat nullable)
            $table->string('tujuan')->nullable();       // Untuk Organik
            $table->string('pengangkut')->nullable();   // Untuk Domestik

            // Dokumen & Keterangan
            $table->string('no_dokumen')->nullable();
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('non_b3_logbooks');
    }
};
