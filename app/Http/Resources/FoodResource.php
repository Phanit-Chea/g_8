<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this ->id,
            'user' => $this->user_id,
            'category_id' => $this -> category_id,
            'name' => $this->name,
            'image' => $this->image,
            'video_url' => $this->video_url,
            'cooking_time' => $this->cooking_time,
            'ingredients' => $this->ingredients,
        ];
    }
}
