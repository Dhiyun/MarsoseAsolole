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
        Schema::create('laporan_spk', function (Blueprint $table) {
            $table->bigIncrements('id_spk');
            $table->unsignedBigInteger('id_kriteria')->index();
            $table->unsignedBigInteger('id_alternatif')->index();
            $table->decimal('nilai', 10, 2);
            $table->timestamps();

            $table->foreign('id_kriteria')
                  ->references('id_kriteria')
                  ->on('kriterias')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('id_alternatif')
                  ->references('id_alternatif')
                  ->on('alternatif')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_spk');
    }
};