<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'cover_letter' => $this->cover_letter,
            'status' => $this->status,
            'user' => new UserResource($this->whenLoaded('user')),
            'job' => new JobResource($this->whenLoaded('job')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}