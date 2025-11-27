<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('room_prokers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->year('year')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['ongoing','completed'])->default('ongoing');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['room_id','status']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('room_prokers');
    }
};
