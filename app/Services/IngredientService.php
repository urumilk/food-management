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

    public function destroyIngredient($id)
    {
        $this->ingredientRepository->destroy($id);
    }
}