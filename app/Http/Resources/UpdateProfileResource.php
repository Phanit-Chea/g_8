<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=> $this->name,
            'email'=> $this->email,
            'phoneNumber'=> $this->phoneNumber,
            'gender'=> $this->gender,
            'dateOfBirth'=> $this->dateOfBirth,
            'profile'=> $this->profile,
            'address'=> $this->address,
            'userId'=> $this->id,
        ]
        ;
    }
}
