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
        Schema::create('kop_surat', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_jadwal');
            $table->string('nama_formulir')->nullable();
            $table->string('no_dokumen')->nullable();
            $table->string('no_revisi')->nullable();
            $table->date('tanggal_berlaku')->nullable();
            $table->string('halaman')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kop_surat');
    }
};
