<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->enum('activity_type', [
                'document_uploaded','document_approved','document_revision','room_created','member_added'
            ]);
            $table->string('title');
            $table->text('description');
            $table->foreignId('actor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('document_id')->nullable()->constrained('documents')->nullOnDelete();
            $table->timestamps();

            $table->index(['room_id','activity_type']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('timelines');
    }
};
