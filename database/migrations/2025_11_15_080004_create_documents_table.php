<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('room_id')
                ->constrained('rooms')
                ->onDelete('cascade');

            $table->foreignId('proker_id')
                ->nullable()
                ->constrained('room_prokers')
                ->nullOnDelete();

            $table->string('title');
            $table->enum('document_type', ['proposal','lpj','layout_bpp','spj']);
            $table->string('file_path');

            $table->foreignId('submitted_by')
                ->constrained('users')
                ->onDelete('cascade');

            $table->timestamp('submitted_at')->useCurrent();
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['room_id', 'document_type']);
            $table->index(['submitted_by', 'submitted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
