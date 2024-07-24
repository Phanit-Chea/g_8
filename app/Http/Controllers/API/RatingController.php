<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListFeedbackResource;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = Rating::all();
        $ratings = ListFeedbackResource::collection($ratings);
        return response()->json(['success' => true, 'data' => $ratings], 200);
    }

    public function store(Request $request)
    {
        $rating = Rating::create([
            'food_id' => $request->food_id,
            'user_id' => $request->user_id,
            'stars_rating' => $request->stars_rating,
            'feedback' => $request->feedback,
        ]);

        return response()->json($rating, 201);
    }

    public function countUsersRatedFood($foodId)
    {
        $count = Rating::where('food_id', $foodId)
            ->distinct('user_id')
            ->count('user_id');

        return response()->json(['count' => $count]);
    }

    public function calculateAverageRating($foodId)
    {
        $ratings = Rating::where('food_id', $foodId)->get(['stars_rating', 'feedback']);

        $totalStars = $ratings->sum('stars_rating');
        $countUsers = $ratings->count();

        if ($countUsers > 0) {
            $averageRating = $totalStars / $countUsers;
        } else {
            $averageRating = 0; // Handle the case where no users have rated yet
        }

        $averageRating = number_format($averageRating, 1);

        return response()->json([
            'average_rating' => $averageRating,
            'feedback' => $ratings->pluck('feedback')->toArray(),
        ]);
    }

    public function show($foodId)
    {
        $feedbackData = Rating::where('food_id', $foodId)
            ->select('ratings.id', 'ratings.stars_rating', 'ratings.feedback', 'users.name', 'users.profile')
            ->join('users', 'ratings.user_id', '=', 'users.id')
            ->get()
            ->toArray();

        return response()->json(['average_rating' => $feedbackData]);
    }

    public function destroy($id)
    {
        $rating = Rating::find($id);

        if ($rating) {
            $rating->delete();
            return response()->json(['message' => 'Comment deleted successfully.']);
        } else {
            return response()->json(['message' => 'Comment not found.'], 404);
        }
    }
}
