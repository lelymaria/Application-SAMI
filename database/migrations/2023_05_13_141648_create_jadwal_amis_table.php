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
        Schema::create('jadwal_ami', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_jadwal');
            $table->dateTime('jadwal_mulai');
            $table->dateTime('jadwal_selesai');
            $table->string('tahun_ami');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ami');
    }
};
