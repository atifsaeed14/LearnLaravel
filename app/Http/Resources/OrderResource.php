<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id'=> $this->id,
            "number"=>$this->number,
            "source"=>$this->source,
            "status"=>$this->status,
            "active"=>$this->active,
            "instruction"=>$this->instruction,
            "first_name"=>$this->first_name,
            "last_name"=>$this->last_name,
            "email"=>$this->email,
            "mobile"=>$this->mobile,
            "lineland"=>$this->lineland,
            "billing_address1"=>$this->billing_address1,
            "billing_address2"=>$this->billing_address2,
            "billing_city"=>$this->billing_city,
            "billing_state"=>$this->billing_state,
            "billing_postal_code"=>$this->billing_postal_code,
            "billing_country"=>$this->billing_country,
            "shipping_address1"=>$this->shipping_address1,
            "shipping_address2"=>$this->shipping_address2,
            "shipping_city"=>$this->shipping_city,
            "shipping_state"=>$this->shipping_state,
            "shipping_postal_code"=>$this->shipping_postal_code,
            "shipping_country"=>$this->shipping_country,
            "promo"=>$this->promo,
            "coupon_id"=>$this->coupon_id,
            "subtotal"=>$this->subtotal,
            "shipping"=>$this->shipping,
            "tax"=>$this->tax,
            "discount"=>$this->discount,
            "total"=>$this->total,
            'members'=> UserResource::collection($this->whenLoaded('members')),
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
            'user_id'=> $this->user_id
        ];
    }
}
