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
        // Membuat tabel users
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('username_admin')->unique();
            $table->string('password_admin');
            $table->string('name_admin');
            $table->string('position_admin');
            $table->string('group_admin');
            $table->string('role_admin');
            $table->rememberToken(); 
            $table->timestamps();
        });

        // (Opsional) Membuat tabel password_reset_tokens jika diperlukan
        Schema::create('password_reset_tokens_admin', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // (Opsional) Membuat tabel sessions jika diperlukan
        Schema::create('sessions_admin', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
