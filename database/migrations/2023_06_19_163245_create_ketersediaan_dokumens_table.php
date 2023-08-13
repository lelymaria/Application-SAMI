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
        Schema::create('ketersediaan_dokumen', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_pertanyaan');
            $table->uuid('id_jadwal');
            $table->uuid('id_kop_surat');
            $table->uuid('id_user');
            $table->dateTime('tanggal_input_dokKetersediaan');
            $table->string('no_audit');
            $table->text('nama_dokumen');
            $table->string('ketersediaan_dokumen');
            $table->string('pic');
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketersediaan_dokumen');
    }
};
