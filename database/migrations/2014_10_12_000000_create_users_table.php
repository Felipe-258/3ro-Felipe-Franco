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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role')->nullable()->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        // Inserta la fila por defecto
        DB::table('users')->insert([
            'name' => 'Admin',
            'email'=> 'admin@admin.com',
            'password' => '$2y$10$/KvZ4T//TM4ybmrjWIQDiOok9M8zUsPPGuam2gOwM674M70E84pPq',
            'role'=> '1',
            'created_at' => now(),
            'updated_at'=> now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
