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
        Schema::create('status_dokumen', function (Blueprint $table) {
            $table->id('id_status_dokumen');
            $table->string('status_awal', 10)->nullable();
            $table->string('status_baru', 10);
            $table->text('komentar')->nullable();
            $table->unsignedBigInteger('id_dokumen');
            $table->unsignedBigInteger('id_pengguna');
            $table->timestamp('waktu_perubahan')->useCurrent();
            $table->foreign('id_dokumen')->references('id_dokumen')->on('dokumen')->onDelete('cascade');
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_dokumen');
    }
};
