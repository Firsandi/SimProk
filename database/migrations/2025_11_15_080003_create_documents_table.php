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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->string('title');
            $table->enum('document_type', ['proposal','lpj','layout_bpp','spj']);
            $table->string('file_path');
            $table->foreignId('submitted_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('submitted_at')->useCurrent();
            $table->text('notes')->nullable();
            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
