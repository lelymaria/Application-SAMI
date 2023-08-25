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
        Schema::create('foto_kegiatan_rtm', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_undangan')->references('id')->on('undangan_rtm')->cascadeOnDelete();
            $table->foreignUuid('id_jadwal')->references('id')->on('jadwal_ami')->cascadeOnDelete();
            $table->string('caption_foto_kegiatan_rtm');
            $table->string('file_foto_kegiatan_rtm');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_kegiatan_rtm');
    }
};
