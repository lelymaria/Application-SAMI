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
        Schema::create('foto_kegiatan_ami', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_undangan');
            $table->string('caption_foto_kegiatan_ami');
            $table->string('file_foto_kegiatan_ami');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_kegiatan_ami');
    }
};
