<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FavoriteIngredientRequest;
use App\Services\FavoriteIngredientService;

class FavoriteIngredientController extends Controller
{
    private $favoriteIngredientService;

    public function __construct(FavoriteIngredientService $favoriteIngredientService)
    {
        $this->favoriteIngredientService = $favoriteIngredientService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favoriteIngredients = $this->favoriteIngredientService->indexFavoriteIngredient();
        return view('favorite_ingredients.index', compact('favoriteIngredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FavoriteIngredientRequest $request)
    {
        try {
        $validated = $request->validated();
        \Log::info('バリデーション通過', $validated);

        $ingredient = $this->favoriteIngredientService->storeFavoriteIngredient($validated);
        return response()->json($ingredient, 201);
        } catch (\Throwable $e) {
        \Log::error('エラー発生: ' . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
        }

        // $validated = $request->validated();
        // dd($validated);
        // $ingredient = $this->favoriteIngredientService->storeFavoriteIngredient($validated);
        // return response()->json($ingredient, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if(!empty($ids)){
            $this->favoriteIngredientService->bulkDeleteIngredient($ids);
            return response()->json([
                'message' => '選択した食材を削除しました。'
            ], 200);
        }

        return response()->json([
                'message' => '削除する項目を選択してください。'
            ], 422);
    }
}
