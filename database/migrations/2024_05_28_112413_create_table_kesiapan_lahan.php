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
        Schema::create('table_kesiapan_lahan', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->string('cuaca_lokasi_amp');
            $table->string('foto_cuaca_amp');
            $table->string('lokasi_cuaca_amp');
            $table->dateTime('waktu_dokumentasi_cuaca_amp');
            $table->string('cuaca_lahan_penghamparan');
            $table->string('foto_lahan_penghamparan');
            $table->string('lokasi_lahan_penghamparan');
            $table->dateTime('waktu_dokumentasi_lahan_penghamparan');
            $table->string('kondisi_lahan_penghamparan');
            $table->string('foto_kondisi_lahan_penghamparan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_kesiapan_lahan');
    }
};
