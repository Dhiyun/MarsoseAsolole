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
        Schema::create('alternatif', function (Blueprint $table) {
            $table->bigIncrements('id_alternatif');
            $table->string('kode_alternatif', 10)->nullable();
            $table->unsignedBigInteger('id_laporan')->index();
            $table->timestamps();

            $table->foreign('id_laporan')
                  ->references('id_laporan')
                  ->on('laporan_pengaduan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternatif');
    }
};