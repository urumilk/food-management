<?php
namespace App\Services;

use App\Repositories\FavoriteIngredientRepository;

class FavoriteIngredientService{

    private $favoriteIngredientService;

    public function __construct(FavoriteIngredientRepository $favoriteIngredientRepository)
    {
        $this->favoriteIngredientRepository = $favoriteIngredientRepository;
    }

    public function indexFavoriteIngredient()
    {
        return $this->favoriteIngredientRepository->index();
    }

    public function storeFavoriteIngredient(array $data)
    {
        $ingredient = $this->favoriteIngredientRepository->store($data);
        return $ingredient;
    }

}