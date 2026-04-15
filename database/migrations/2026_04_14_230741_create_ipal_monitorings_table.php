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
        // Schema::create('ipal_monitorings', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        Schema::create('ipal_monitorings', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');

            // Parameter Kualitas Air
            $table->decimal('ph_inlet', 5, 2)->nullable();
            $table->decimal('ph_outlet', 5, 2)->nullable();
            $table->string('status_ph')->nullable();
            $table->decimal('suhu', 5, 2)->nullable();

            // Debit Air
            $table->decimal('debit_pagi', 8, 2)->nullable();
            $table->decimal('debit_sore', 8, 2)->nullable();
            $table->decimal('total_debit', 8, 2)->nullable(); // Bisa di-generate otomatis

            // Fisik & Kimia
            $table->string('warna')->nullable();
            $table->string('bau')->nullable();
            $table->decimal('bahan_kimia', 8, 2)->nullable();

            // Lain-lain
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipal_monitorings');
    }
};
