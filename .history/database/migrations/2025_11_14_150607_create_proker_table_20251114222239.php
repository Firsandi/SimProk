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
        Schema::create('proker', function (Blueprint $table) {
            $table->id('id_proker');
            $table->string('nama_proker', 50);
            $table->integer('tahun');
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('id_ukm_ormawa');
            $table->timestamps();
            $table->foreign('id_ukm_ormawa')->references('id_ukm_ormawa')->on('ukm_ormawa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proker');
    }
};
