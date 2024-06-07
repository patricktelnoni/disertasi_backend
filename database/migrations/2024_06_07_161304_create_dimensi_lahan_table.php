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
        Schema::create('dimensi_lahan', function (Blueprint $table) {
            $table->id();
            $table->string('peruntukan');
            $table->integer('panjang');
            $table->text('lokasi_foto_panjang');
            $table->text('foto_panjang');
            $table->dateTime('waktu_dokumentasi_foto_panjang');
            $table->integer('lebar');
            $table->text('lokasi_foto_lebar');
            $table->text('foto_lebar');
            $table->dateTime('waktu_dokumentasi_foto_lebar');
            $table->integer('tebal');
            $table->text('lokasi_foto_tebal');
            $table->text('foto_tebal');
            $table->dateTime('waktu_dokumentasi_foto_tebal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dimensi_lahan');
    }
};
