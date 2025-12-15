<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // cria usuário de teste opcional (idempotente para rodar seed várias vezes)
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // chama o seeder Testes
        $this->call([
            Testes::class,
        ]);
    }
}
