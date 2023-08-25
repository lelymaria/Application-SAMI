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
        Schema::create('pertanyaan_standar', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_standar')->references('id')->on('standar')->cascadeOnDelete();
            $table->foreignUuid('id_jadwal')->references('id')->on('jadwal_ami')->cascadeOnDelete();
            $table->text('list_pertanyaan_standar');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaan_standar');
    }
};
