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
        Schema::create('laporan_pengaduan', function (Blueprint $table) {
            $table->bigIncrements('id_laporan');
            $table->date('tanggal_laporan')->nullable();
            $table->string('jenis_laporan', 50)->nullable();
            $table->string('gambar', 255)->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->enum('status', ['ditolak', 'diterima', 'selesai'])->nullable();
            $table->unsignedBigInteger('id_warga')->index();
            $table->timestamps();

            $table->foreign('id_warga')
                  ->references('id_warga')
                  ->on('warga')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_pengaduan');
    }
};

