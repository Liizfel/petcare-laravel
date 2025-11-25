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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();

            // Chave estrangeira para o dono do pet
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('nome');
            $table->string('especie');
            $table->integer('idade');
            $table->decimal('peso', 5, 2); // Ex: 12.50 kg
            $table->string('foto')->nullable(); // Foto é opcional

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
