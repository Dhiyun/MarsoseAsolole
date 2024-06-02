<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('kriterias', function (Blueprint $table) {
            $table->id('id_kriteria');
            $table->string('nama_kriteria', 255);
            $table->enum('jenis_kriteria', ['Benefit', 'Cost']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('kriterias');
    }
};
