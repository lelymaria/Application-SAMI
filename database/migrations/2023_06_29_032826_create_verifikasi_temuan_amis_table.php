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
        Schema::create('verifikasi_temuan_ami', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_standar')->references('id')->on('standar')->cascadeOnDelete();
            $table->foreignUuid('id_jadwal')->references('id')->on('jadwal_ami')->cascadeOnDelete();
            $table->foreignUuid('id_user')->references('id')->on('users')->cascadeOnDelete();
            $table->dateTime('tanggal_verifikasi');
            $table->text('verifikasi_kp4mp')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_temuan_ami');
    }
};
