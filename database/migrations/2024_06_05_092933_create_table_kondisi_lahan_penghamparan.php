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
        Schema::create('table_kondisi_lahan_penghamparan', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('table_kondisi_lahan_penghamparan');
    }
};
