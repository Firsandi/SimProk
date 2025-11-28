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
        Schema::create('room_proker', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proker');
            $table->year('tahun');
            $table->text('deskripsi')->nullable();
            $table->foreignId('user_id')->constrained('users')->nullable();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_proker');
    }
};
