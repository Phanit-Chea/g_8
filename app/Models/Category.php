<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'name', 'description', 'media_id'];

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }
    public function food()
    {
        return $this->hasMany(Food::class);
    }

    public static function list()
    {
        return self::all();
    }

    public static function createOrUpdate($request, $id = null)
    {
        $media_id = Media::createOrUpdate($request);
        $category = [
            'title' => $request->title,
            'name' => $request->name,
            'description' => $request->description,
            'media_id' => $media_id,
        ];
        $category = self::updateOrCreate(['id' => $id], $category);
        return $category;
    }
}
