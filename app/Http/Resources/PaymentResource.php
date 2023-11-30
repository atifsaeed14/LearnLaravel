<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
        public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return[
            'id'=> $this->id,
            'amount'=> $this->amount,
            'source'=> $this->source,
            'status'=> $this->status,
            'note'=> $this->note,
            'order_id'=> $this->order_id,
            'members'=> UserResource::collection($this->whenLoaded('orderMembers')),
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
            'user_id'=> $this->user_id
        ];
    }
}
