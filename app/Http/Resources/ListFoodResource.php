<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListFoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        {
            return [
                'id' => $this->id,
                'user_id' => $this->user_id,
                'food_name' => $this->food_name,
                'upload_image' => $this->upload_image,
                'video_url' => $this->video_url,
                'cooking_time' => $this->cooking_time,
                'ingredient' => $this->ingredient,
                'how_to_cook' => $this->how_to_cook,
            ];
        }
    }
}
