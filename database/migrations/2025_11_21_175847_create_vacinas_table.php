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
        Schema::create('vacinas', function (Blueprint $table) {
            $table->id();

            // Chave Estrangeira para o Pet (Pet_ID)
            $table->foreignId('pet_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('descricao'); // Ex: V10, Antirrábica
            $table->date('data_aplicada');
            $table->date('proxima_dose')->nullable(); // Opcional, para doses únicas ou completas

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacinas');
    }
};
