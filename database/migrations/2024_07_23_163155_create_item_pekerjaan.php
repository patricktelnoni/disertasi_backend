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
        Schema::create('item_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->text('nama_item_pekerjaan');
            $table->text('satuan_pekerjaan');
            $table->integer('harga_satuan');
            $table->integer('volume_pekerjaan');
            $table->foreignId('proyek_id')->constrained('table_info_proyek')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_pekerjaan');
    }
};
