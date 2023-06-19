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
        Schema::create('undangan_rtm', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_jadwal');
            $table->string('file_nama');
            $table->string('file_undangan_rtm');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('undangan_rtm');
    }
};
