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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();

            // Chave Estrangeira para o Pet
            $table->foreignId('pet_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->date('data_consulta');
            $table->string('motivo');
            $table->text('observacoes')->nullable(); // Campo longo, opcional

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
