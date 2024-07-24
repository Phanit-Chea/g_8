<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryMedia\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "name" => $this->name,
            "description" => $this->description,
            "image" => new MediaResource($this->media)
        ];
    }
}
