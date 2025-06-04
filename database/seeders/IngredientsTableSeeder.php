<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ingredient::create([
            'name' => 'りんご',
            'expiration_date' => now()->addDays(3),
            'user_id' => 1,
        ]);

        Ingredient::create([
            'name' => 'たまご',
            'expiration_date' => now()->addDays(7),
            'user_id' => 1,
        ]);
    }
}
