<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutUsSlide extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'imageSlide',
    ];
    public static function list(){
        return self::all();
    }
}
