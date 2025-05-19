<?php

namespace App\Repositories;

use App\Models\Ingredient;
use Carbon\CarbonImmutable;

class IngredientRepository{

    public function create(array $data)
    {
        Ingredient::create([
            'name' => $data['name'],
            'expiration_date' => $data['expiration_date'],
            'user_id' => auth()->id(),
        ]);
    }


}