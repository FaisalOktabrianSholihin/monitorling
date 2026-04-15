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
        // Schema::create('b3_inspection_items', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        Schema::create('b3_inspection_items', function (Blueprint $table) {
            $table->id();

            // Ini jembatan penghubung ke tabel induk
            $table->foreignId('b3_inspection_id')->constrained('b3_inspections')->cascadeOnDelete();

            $table->string('area_zona');
            $table->text('parameter');
            $table->string('status');
            $table->string('foto_temuan')->nullable();
            $table->text('tindakan_segera')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->string('pic')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b3_inspection_items');
    }
};
