<?php
namespace App\Services;

use App\Repositories\IngredientRepository;
use App\Repositories\FavoriteIngredientRepository;
use Illuminate\Pagination\LengthAwarePaginator;


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
                $sortedIngredients = $rawIngredients -> sortby('expiration_date');
                break;
            case 'expiration_desc':
                $sortedIngredients = $rawIngredients -> sortByDesc('expiration_date');
                break;
            default :
                $sortedIngredients = $rawIngredients -> latest();
                break;
        }

        $page = $request->get('page', 1);
        $perPage = 10;
        $currentPageData = $sortedIngredients->slice(($page-1) * $perPage, $perPage)->values();

        $ingredients = new LengthAwarePaginator(
            $currentPageData, 
            $rawIngredients->count(), 
            $perPage, 
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return $ingredients;
    }

    public function allIngredient()
    {
        return $this->ingredientRepository->index();

    }

    public function recommendFromFavorites()
    {
        return $this->ingredientRepository->recommendFromFavorites();
    }

    public function storeIngredient($names, $dates)
    {
        if (!$names || !is_array($names)) 
        {
            return back()->withErrors(['name' => '食材名は必須です'])->withInput();
        }

        $this->ingredientRepository->create($names, $dates);
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

    public function bulkDeleteIngredient(array $ids)
    {
        $this->ingredientRepository->bulkDelete($ids);
    }

}