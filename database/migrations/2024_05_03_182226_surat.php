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
        Schema::create('surat', function (Blueprint $table) {
            $table->bigIncrements('id_surat');
            $table->string('jenis_surat', 100)->nullable();
            $table->string('nama_surat', 100)->nullable();
            $table->string('file_surat', 255)->nullable();
            $table->string('alur_pengurusan', 255)->nullable();
            $table->unsignedBigInteger('id_warga')->index();
            $table->unsignedBigInteger('id_kategorisurat')->index();
            $table->timestamps();
            
            $table->foreign('id_warga')
                  ->references('id_warga')
                  ->on('warga')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('id_kategorisurat')
                  ->references('id_kategorisurat')
                  ->on('kategori_surat')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
