<?php
// app/Http/Controllers/SeasonController.php
namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index()
    {
        $currentSeason = Season::getCurrentSeason();
        // Use the $currentSeason variable in your controller logic
        return response()->json(["current season is"=>$currentSeason]);
    }

    // Other controller actions as needed
}
