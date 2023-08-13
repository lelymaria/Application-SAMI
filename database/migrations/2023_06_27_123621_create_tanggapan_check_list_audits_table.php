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
            $table->uuid('id_pertanyaan');
            $table->uuid('id_jadwal');
            $table->uuid('id_user');
            $table->uuid('id_check_list_audit');
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
