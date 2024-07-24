<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShowFoodResource;
use App\Models\Food;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FoodRequest;
use App\Http\Resources\FoodResource;
use Exception;





class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $food = Food::all();
        $food = FoodResource::collection($food);
        return response(['success' => true, 'data' => $food], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    // FoodController.php
    public function store(FoodRequest $request)
    {
        // Ensure the request comes from an authenticated user
        $userID = Auth::id();
        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $ext = $img->getClientOriginalExtension();
                $imageName = time() . '.' . $ext;
                $profilePath = 'storage/images';
                $img->move(public_path($profilePath), $imageName);
                $imagePath = $profilePath . '/' . $imageName;
            }

            $food = Food::create([
                'user_id' => $userID,
                'category_id' => $request->input('category_id'),
                'name' => $request->input('name'),
                'image' => $imagePath,
                'video_url' => $request->input('video_url'),
                'cooking_time' => $request->input('cooking_time'),
                'ingredients' => $request->input('ingredients'),
            ]);
            return response()->json($food, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        $food = Food::findOrFail($id);

        // Split the ingredients string into an array
        $ingredients = explode(',', $food->ingredients);

        // Trim any leading/trailing whitespace from the ingredients
        $ingredients = array_map('trim', $ingredients);

        return response()->json([
            'id' => $food->id,
            'category_id' => $food->category_id,
            'name' => $food->name,
            'image' => $food->image,
            'video_url' => $food->video_url,
            'cooking_time' => $food->cooking_time,
            'ingredients' => $ingredients,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullable|integer',
            'category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'video_url' => 'required|url',
            'cooking_time' => 'required|string|max:255',
            'ingredients' => 'required|string',
        ]);

        $food = Food::findOrFail($id);


        $imagePath = $food->image;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $profilePath = 'storage/images';
            $img->move(public_path($profilePath), $imageName);
            $imagePath = $profilePath . '/' . $imageName;
        }

        $food->update([
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'video_url' => $validatedData['video_url'],
            'cooking_time' => $validatedData['cooking_time'],
            'ingredients' => $validatedData['ingredients'],
        ]);

        return response()->json($food, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $food = Food::findOrFail($id);
            if ($food->delete()) {
                return response()->json([
                    'data' => null,
                    'message' => 'Food deleted successfully',
                ], 204);
            } else {
                return response()->json([
                    'data' => null,
                    'error' => 'Failed to delete food',
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function listFoodByCategory($id)
    {
        $food = Food::where('category_id', $id)->get();

        if ($food->isEmpty()) {
            return response()->json([
                'message' => 'No food items found for the given category.',
            ], 404);
        }

        return response()->json($food, 200);
    }
    public function getRandomFood($categoryID, Request $request)
    {
        $dishes = Food::where('category_id', $categoryID)->get(); // Get all dishes
        $suitableFood = [];

        // Get the current season
        $currentSeason = Season::getCurrentSeason();
        

        if ($currentSeason === 'Rainy') {
            $unwantedIngredients = ['Spicy', 'spicy', 'salty']; // Example unwanted ingredients
        } elseif ($currentSeason === 'Dry') {
            $unwantedIngredients = ['sour']; // Example unwanted ingredients
        }

        // Filter out dishes with unwanted ingredients
        foreach ($dishes as $dish) {
            $ingredients = explode(',', $dish->ingredients); // Split the ingredients string into an array
            $isValid = true;

            foreach ($ingredients as $ingredient) {
                if (in_array(trim($ingredient), $unwantedIngredients)) {
                    $isValid = false;
                    break;
                }
            }

            if ($isValid) {
                $suitableFood[] = $dish;
            }
        }

        // Use the current date as a seed for randomness
        $seed = strtotime(date('Y-m-d')); // Get the current date as a timestamp
        srand($seed); // Seed the random number generator
        $count = $request->input('count');
        // Return the specified number of random suitable foods, defaulting to 6
        $count = min($count, count($suitableFood)); // Ensure count does not exceed available suitable foods
        if ($count > 0) {
            $randomFoods = array_rand($suitableFood, $count);
            $selectedFoods = [];

            if (is_array($randomFoods)) {
                foreach ($randomFoods as $index) {
                    $selectedFoods[] = $suitableFood[$index];
                }
            } else {
                $selectedFoods = [$suitableFood[$randomFoods]];
            }

            // Reset the random number generator to avoid side effects
            srand();

            return response()->json([
                'suitable_food' => $selectedFoods
            ]);
        } else {
            return response()->json([
                'suitable_food' => null
            ]);
        }
    }
}
