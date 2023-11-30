<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CatagoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'id'=> $this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'thumbnail'=>$this->thumbnail,
            'slug'=>$this->slug,
            //'members'=> UserResource::collection($this->whenLoaded('members')),
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
            'user_id'=> $this->user_id
         ];
    }
}
