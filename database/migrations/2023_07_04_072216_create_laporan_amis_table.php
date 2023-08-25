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
        Schema::create('laporan_ami', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_jadwal')->references('id')->on('jadwal_ami')->cascadeOnDelete();
            $table->foreignUuid('id_user')->references('id')->on('users')->cascadeOnDelete();
            $table->uuid('id_unit_kerja');
            $table->string('file_nama');
            $table->string('file_laporan_ami');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_ami');
    }
};
