<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=> $this->id,
            'title'=> $this->title,
            'status'=> $this->status,
            'quantity'=> $this->quantity,
            'price'=> $this->price,
            'discount'=> $this->discount,
            'store_id'=> $this->store_id,
            'product_id'=> $this->product_id,
            'order_id'=> $this->order_id,
            'members'=> UserResource::collection($this->whenLoaded('orderMembers')),
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
            'user_id'=> $this->user_id
        ];
    }
}
