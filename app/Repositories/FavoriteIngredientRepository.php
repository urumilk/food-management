<?php

namespace App\Repositories;

use App\Models\FavoriteIngredient;

class FavoriteIngredientRepository{

    public function index()
    {
        return FavoriteIngredient::where('user_id', auth()->id())->get();
    
    }

    public function store(array $data)
    {
        $ingredient = FavoriteIngredient::create([
            'name' => $data['name'],
            'user_id' => auth()->id(),
        ]);
        
        return $ingredient;
    }

}