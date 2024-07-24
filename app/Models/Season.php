<?php
// app/Models/Season.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Season
{
    use HasFactory;

    public static function getCurrentSeason()
    {
        $currentMonth = Carbon::now()->format('m');


        if ($currentMonth >= 5 && $currentMonth <= 10) {
            return 'Rainy';
        } else {
            return 'Dry';
        }
    }
}