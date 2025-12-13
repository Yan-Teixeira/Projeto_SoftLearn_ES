<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // cria usuário de teste opcional
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // chama o seeder Testes
        $this->call([
            Testes::class,
        ]);
    }
}
