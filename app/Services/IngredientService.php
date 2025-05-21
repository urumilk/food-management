<?php
namespace App\Services;

use App\Repositories\IngredientRepository;

class IngredientService{
    
    private $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
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