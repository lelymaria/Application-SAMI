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
        Schema::create('check_list_audit', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_pertanyaan');
            $table->uuid('id_jadwal');
            $table->string('kesesuaian');
            $table->text('catatan_khusus')->nullable();
            $table->text('hasil_observasi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_list_audit');
    }
};
