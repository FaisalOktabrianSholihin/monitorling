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
        // Schema::create('b3_logbooks', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        Schema::create('b3_logbooks', function (Blueprint $table) {
            $table->id();

            // Kategori Transaksi
            $table->string('jenis_limbah');
            $table->enum('tipe_transaksi', ['Masuk', 'Keluar']);

            // Data Utama
            $table->date('tanggal');
            $table->decimal('jumlah', 8, 2);

            // Atribut Masuk
            $table->string('sumber_limbah')->nullable();

            // Atribut Keluar
            $table->string('tujuan_vendor')->nullable();
            $table->string('no_manifest')->nullable();

            // Tambahan
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b3_logbooks');
    }
};
