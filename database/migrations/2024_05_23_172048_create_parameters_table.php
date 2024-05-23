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
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->integer('promocion');
            $table->integer('regular');
            $table->integer('total');
            $table->timestamps();
        });

        // Inserta la fila por defecto
        DB::table('parameters')->insert([
            'promocion' => '80',
            'regular'=> '60',
            'total'=> '100',
            'created_at' => now(),
            'updated_at'=> now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameters');
    }
};
