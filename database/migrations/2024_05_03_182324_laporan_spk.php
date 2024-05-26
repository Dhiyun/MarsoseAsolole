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
            $table->string('jenis_laporan', 100)->nullable();
            $table->integer('biaya')->nullable();
            $table->integer('dampak')->nullable();
            $table->integer('durasi_pekerjaan')->nullable();
            $table->integer('sdm')->nullable();
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
        Schema::dropIfExists('laporan_spk');
    }
};
