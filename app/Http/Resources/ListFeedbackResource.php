<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListFeedbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stars_rating' => $this->stars_rating,
            'feedback' => $this->feedback,
            'user' => [
                'name' => $this->user->name,
                'profile' => $this->user->image,
            ],
        ];
    }
}
