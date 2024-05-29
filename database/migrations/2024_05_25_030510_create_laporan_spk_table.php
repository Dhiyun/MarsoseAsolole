<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanSpkTable extends Migration
{
    public function up()
    {
        Schema::create('laporan_spk_coba', function (Blueprint $table) {
            $table->bigIncrements('ID_SPK');
            $table->string('jenis_laporan', 100)->nullable();
            $table->integer('biaya')->nullable();
            $table->integer('dampak')->nullable();
            $table->integer('durasi_pekerjaan')->nullable();
            $table->integer('sdm')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_spk');
    }
}

