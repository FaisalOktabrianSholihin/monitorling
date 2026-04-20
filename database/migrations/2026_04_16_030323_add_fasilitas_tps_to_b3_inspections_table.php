<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::table('b3_inspections', function (Blueprint $table) {
    //         //
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  */
    // public function down(): void
    // {
    //     Schema::table('b3_inspections', function (Blueprint $table) {
    //         //
    //     });
    // }

    public function up(): void
    {
        Schema::table('b3_inspections', function (Blueprint $table) {
            $table->string('tps_simbol')->nullable();
            $table->string('tps_palet')->nullable();
            $table->string('tps_spillkit')->nullable();
            $table->string('tps_apar')->nullable();
            $table->string('tps_lantai')->nullable();
            $table->string('tps_ventilasi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('b3_inspections', function (Blueprint $table) {
            $table->dropColumn([
                'tps_simbol',
                'tps_palet',
                'tps_spillkit',
                'tps_apar',
                'tps_lantai',
                'tps_ventilasi'
            ]);
        });
    }
};
