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
        Schema::create('kk', function (Blueprint $table) {
            $table->id('id_kk');
            $table->char('no_kk', 16)->unique();
            $table->string('kepala_keluarga', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->unsignedBigInteger('id_rt')->index;
            $table->timestamps();

            $table->foreign('id_rt')
                  ->references('id_rt')
                  ->on('rt')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kk');
    }
};
