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
        Schema::create('data_dukung_auditee', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_standar');
            $table->uuid('id_jadwal');
            $table->text('nama_file');
            $table->string('data_file');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_dukung_auditee');
    }
};
