<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class aboutUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'imageDetail' => $this->imageDetail,
            'description' => $this->description,
            'recommentFood' => $this->commentFood,
            'ourMission' => $this->ourMission,
            'ourVision' => $this->ourVision

        ];
    }
}
