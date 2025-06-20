<?php

namespace App\Repositories;

use App\Models\Ingredient;
use App\Models\FavoriteIngredient;
use Carbon\CarbonImmutable;

class IngredientRepository{

    public function index()
    {
        $data = Ingredient::where('user_id', auth()->id());
        //dd($data);
        $now = CarbonImmutable::today();//now()の場合、小数点以下も表示される

        $rawIngredients = $data->get()->map( function ($ingredient) use ($now) 
            {
                $expirationDate = CarbonImmutable::parse($ingredient->expiration_date);
                $ingredient->diffindays = $now->diffInDays($expirationDate, false);
                return $ingredient;
            });

        return $rawIngredients;

    }

    public function recommendFromFavorites()
    {
        $user = auth()->user();
        return $user->favoriteIngredients()->get();
    }

    public function create($names, $dates)
    {
        foreach ($names as $i => $name) {
            if (empty($name)) continue;

            Ingredient::create([
                'name' => $name,
                'expiration_date' => $dates[$i] ?? null,
                'user_id' => auth()->id(),
            ]);
        }
    }

    public function destroy(int $id)
    {
        Ingredient::destroy($id);
    }

    public function update(array $data, int $id)
    {

        $ingredient = Ingredient::find($id);
        $ingredient -> update($data);
    }

    public function findbyId(int $id)
    {
        $ingredient = Ingredient::find($id);
        return $ingredient;

    }

    public function bulkDelete($ids){
        Ingredient::whereIn('id', $ids)->delete();
    }


}