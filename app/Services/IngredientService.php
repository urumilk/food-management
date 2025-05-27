<?php
namespace App\Services;

use App\Repositories\IngredientRepository;
use App\Repositories\FavoriteIngredientRepository;


class IngredientService{
    
    private $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function indexIngredient($request)
    {
        $rawIngredients = $this->ingredientRepository->index();
        $sortType = $request->input('sort', 'expiration_asc');
        switch ($sortType){ 
            case 'expiration_asc':
                $ingredients = $rawIngredients -> sortby('expiration_date');
                break;
            case 'expiration_desc':
                $ingredients = $rawIngredients -> sortByDesc('expiration_date');
                break;
            default :
                $ingredients = $rawIngredients -> latest();
                break;
        }

        return $ingredients;
    }
    
    public function recommendFromFavorites()
    {
        return $this->ingredientRepository->recommendFromFavorites();
    }

    public function storeIngredient(array $data)
    {
        $this->ingredientRepository->create($data);
    }

    public function destroyIngredient(int $id)
    {
        $this->ingredientRepository->destroy($id);
    }

    public function editIngredient(int $id)
    {
        $ingredient = $this->ingredientRepository->findbyId($id);
        return $ingredient;
    }

    public function updateIngredient(array $data, int $id)
    {

        $this->ingredientRepository->update($data, $id);
    }
}