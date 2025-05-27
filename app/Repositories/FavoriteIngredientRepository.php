<?php

namespace App\Repositories;

use App\Models\FavoriteIngredient;

class FavoriteIngredientRepository{

    public function index()
    {
        return FavoriteIngredient::where('user_id', auth()->id())->get();
    
    }

}