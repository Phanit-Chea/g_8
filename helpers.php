
<?php

use Carbon\Carbon;

function getSeason($hemisphere = 'northern')
{
    $date = Carbon::now();
    $month = $date->month;

    if ($hemisphere == 'northern') {
        if ($month == 12 || $month == 1 || $month == 2) {
            return 'Winter';
        } elseif ($month == 3 || $month == 4 || $month == 5) {
            return 'Spring';
        } elseif ($month == 6 || $month == 7 || $month == 8) {
            return 'Summer';
        } else {
            return 'Fall';
        }
    } else {
        if ($month == 12 || $month == 1 || $month == 2) {
            return 'Summer';
        } elseif ($month == 3 || $month == 4 || $month == 5) {
            return 'Fall';
        } elseif ($month == 6 || $month == 7 || $month == 8) {
            return 'Winter';
        } else {
            return 'Spring';
        }
    }
}
