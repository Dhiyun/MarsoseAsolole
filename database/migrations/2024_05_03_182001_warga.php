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
        Schema::create('warga', function (Blueprint $table) {
            $table->id('id_warga');
            $table->char('nik', 16)->unique();
            $table->string('nama', 100)->nullable();
            $table->enum('jenis_kelamin', ['perempuan', 'laki-laki'])->default('laki-laki');
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('agama', 20)->nullable();
            $table->date('periode_jabatan_awal')->nullable();
            $table->date('periode_jabatan_akhir')->nullable();
            $table->unsignedBigInteger('id_user')->index();
            $table->unsignedBigInteger('id_kk')->index()->nullable();
            $table->timestamps();

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('user')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('id_kk')
                  ->references('id_kk')
                  ->on('kk')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
