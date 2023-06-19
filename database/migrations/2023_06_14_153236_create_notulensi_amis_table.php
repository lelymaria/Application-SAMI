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
        Schema::create('notulensi_ami', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_undangan');
            $table->uuid('id_jadwal');
            $table->string('file_notulensi_ami');
            $table->string('file_nama');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notulensi_ami');
    }
};
