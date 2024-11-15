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
        //
        Schema::table('dimensi_lahan', function (Blueprint $table) {
            //
            $table->dropColumn('volume_kumulatif');
            $table->dropColumn('persentase_progress');
            $table->dropColumn('biaya_kumulatif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
