<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Importa o Model User
use App\Models\Pet;  // Importa o Model Pet

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Encontra o primeiro usuário (admin, dono)
        // Isso assume que você tem um User Seeder ou um usuário já criado.
        $user = User::first();

        // Se o usuário não existir, podemos criar um de teste
        if (!$user) {
             $user = User::factory()->create([
                 'name' => 'Dono Teste',
                 'email' => 'teste@petcare.com',
             ]);
        }

        // 2. Cria pets de exemplo vinculados a este usuário
        Pet::create([
            'user_id' => $user->id,
            'nome' => 'Max',
            'especie' => 'Cachorro',
            'idade' => 5,
            'peso' => 12.5,
            // 'foto' => 'max.jpg', // Opcional
        ]);

        Pet::create([
            'user_id' => $user->id,
            'nome' => 'Luna',
            'especie' => 'Gato',
            'idade' => 2,
            'peso' => 4.2,
            // 'foto' => 'luna.jpg',
        ]);
    }
}
