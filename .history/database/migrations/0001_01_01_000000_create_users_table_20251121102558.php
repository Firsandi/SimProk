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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique(); // tambahan
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', [
                'admin',
                'wakil_kemahasiswaan_akademik_alumni',
                'kepala_bagian',
                'bpp',
                'sekretaris',
                'bendahara',
                'user'
            ])->default('user'); // tambahan
            $table->boolean('is_active')->default(true); // tambahan
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('verificationStatus', ['verified', 'pending', 'rejected']);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); // opsional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
