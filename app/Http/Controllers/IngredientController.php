<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IngredientRequest;
use App\Models\Ingredient; //削除する
use Carbon\CarbonImmutable;//削除する
use App\Services\IngredientService;

class IngredientController extends Controller
{
    protected $ingredientService;

    public function __construct(IngredientService $ingredientService)
    {
        $this->ingredientService = $ingredientService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ingredient::where('user_id', auth()->id());

        $sortType = $request->input('sort', 'expiration_asc');
        switch ($sortType){
            case 'expiration_asc':
                $query -> orderby('expiration_date', 'asc');
                break;
            case 'expiration_desc':
                $query -> orderby('expiration_date', 'desc');
                break;
            default :
                $query -> latest();
                break;
        }
        
        $now = CarbonImmutable::today();//now()の場合、小数点以下も表示される

        $ingredients = $query->get()->map( function ($ingredient) use ($now) {
            $expirationDate = CarbonImmutable::parse($ingredient->expiration_date);
            $ingredient->diffindays = $now->diffInDays($expirationDate, false);
            return $ingredient;
        });


        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(IngredientRequest $request)
    // {
    //     $validated = $request->validated();

    //     Ingredient::create([
    //         'name' => $validated['name'],
    //         'expiration_date' => $validated['expiration_date'],
    //         'user_id' => auth()->id(),
    //     ]);

    //     return redirect()->route('ingredients.index')->with('success', '食材を登録しました！');
    // }

    public function store(IngredientRequest $request)
    {
        $validated = $request->validated();

        $this->ingredientService->storeIngredient($validated);       
        return redirect()->route('ingredients.index')->with('success', '食材を登録しました！');

    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $ingredient = $this->ingredientService->editIngredient($id);
        return view('ingredients.edit', compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(IngredientRequest $request, Ingredient $ingredient)
    // {
    //     $ingredient->update($request->validated());
    //     return redirect()->route('ingredients.index');
    // }

    public function update(IngredientRequest $request, int $id)
    {
        $validated = $request->validated();
        $this->ingredientService->updateIngredient($validated, $id);
        return redirect()->route('ingredients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Ingredient $ingredient)
    // {
    //     $ingredient->delete();
    //     return redirect()->route('ingredients.index');
    // }
    public function destroy(int $id)
    {
        $this->ingredientService->destroyIngredient($id);
        return redirect()->route('ingredients.index');
    }
    
}
