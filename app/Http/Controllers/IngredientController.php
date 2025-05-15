<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ダミーデータ
        // $ingredients = [
        //      (object) [
        //         'id' => 1,
        //         'name' => 'りんご',
        //         'expiration_date' => now()->addDays(5)->format('Y-m-d'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     (object) [
        //         'id' => 2,
        //         'name' => '牛乳',
        //         'expiration_date' => now()->addDays(3)->format('Y-m-d'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ];
        $ingredients = Ingredient::all();
        return view('ingredients.index', compact('ingredients'));
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
