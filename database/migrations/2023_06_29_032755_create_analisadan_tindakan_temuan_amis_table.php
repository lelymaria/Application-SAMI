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
        Schema::create('analisa_tindakan_temuan_ami', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_standar');
            $table->uuid('id_jadwal');
            $table->text('analisa_masalah');
            $table->text('tindakan_koreksi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisa_tindakan_temuan_ami');
    }
};
