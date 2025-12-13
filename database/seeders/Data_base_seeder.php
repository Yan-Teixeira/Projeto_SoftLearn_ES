<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Data_base_seeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            \Database\Seeders\Testes::class, // <-- Adicione esta linha
        ]);
    }
}