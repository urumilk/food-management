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

    public function destroy($id)
    {
        Ingredient::destroy($id);
    }

    public function update(array $data, $id)
    {

        $ingredient = Ingredient::find($id);
        $ingredient -> update($data);
    }

    public function findbyId($id)
    {
        $ingredient = Ingredient::find($id);
        return $ingredient;

    }


}