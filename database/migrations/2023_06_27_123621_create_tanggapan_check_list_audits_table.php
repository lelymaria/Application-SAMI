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
        Schema::create('tanggapan_check_list_audit', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_pertanyaan')->references('id')->on('pertanyaan_standar')->cascadeOnDelete();
            $table->foreignUuid('id_jadwal')->references('id')->on('jadwal_ami')->cascadeOnDelete();
            $table->foreignUuid('id_user')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUuid('id_check_list_audit')->references('id')->on('check_list_audit')->cascadeOnDelete();
            $table->text('tanggapan_auditee')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapan_check_list_audit');
    }
};
