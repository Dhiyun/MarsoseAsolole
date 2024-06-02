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
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_spk');
    }
}

