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
        Schema::create('dokumen', function (Blueprint $table) {
    $table->id('id_dokumen');
    $table->unsignedBigInteger('id_proker_pengguna');
    $table->enum('jenis_dokumen', ['proposal','lpj','spj','layout_bpp']);
    $table->string('nama_dokumen');
    $table->unsignedBigInteger('id_status_dokumen')->nullable();
    $table->text('catatan')->nullable();
    $table->timestamps();
    $table->foreign('id_proker_pengguna')->references('id_proker_pengguna')->on('proker_pengguna')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
