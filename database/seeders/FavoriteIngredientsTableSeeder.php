<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FavoriteIngredient;

class FavoriteIngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FavoriteIngredient::create([
            'name' => '食パン',
            'user_id' => 1,
        ]);

        FavoriteIngredient::create([
            'name' => 'カレーパン',
            'user_id' => 1,
        ]);
    }
}
