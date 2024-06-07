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
        Schema::create('table_info_proyek', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kontrak');
            $table->string('nama_paket');
            $table->string('nama_satker');
            $table->string('nama_ppk');
            $table->integer('nilai_kontrak');
            $table->string('lokasi_pekerjaan');
            $table->string('masa_pelaksanaan');
            $table->date('tanggal_pho');
            $table->date('tanggal_kontrak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_info_proyek');
    }
};
