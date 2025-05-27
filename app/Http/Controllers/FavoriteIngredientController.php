<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        //
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
}
