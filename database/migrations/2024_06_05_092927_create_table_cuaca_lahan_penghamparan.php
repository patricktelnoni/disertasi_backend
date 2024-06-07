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
        Schema::create('table_cuaca_lahan_penghamparan', function (Blueprint $table) {
            $table->id();
            $table->string('cuaca_lahan_penghamparan');
            $table->string('foto_lahan_penghamparan');
            $table->string('lokasi_lahan_penghamparan');
            $table->dateTime('waktu_dokumentasi_lahan_penghamparan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_cuaca_lahan_penghamparan');
    }
};
