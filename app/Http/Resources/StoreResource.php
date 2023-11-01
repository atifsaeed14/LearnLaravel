<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;
class StoreResource extends JsonResource
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
            'name'=>$this->name,
            'code'=>$this->code,
            'symbol'=>$this->symbol,
            'email'=>$this->email,
            'tagline'=>$this->tagline,
            'description'=>$this->description,
            'contact'=>$this->contact,
            'contact_type'=>$this->contact_type,
            'cover'=>$this->cover,
            'logo'=>$this->logo,
            'status'=>$this->status,
            'address1'=>$this->address1,
            'address2'=>$this->address2,
            'city'=>$this->city,
            'state'=>$this->state,
            'postal_code'=>$this->postal_code,
            'country'=>$this->country,
            'shipping'=>$this->shipping,
            'tax'=>$this->tax,
            'products'=>($this->id == '') ? [] : (ProductResource::collection($this->whenLoaded('products'))),
            //'products'=>($this->id == '') ? [] : (Product::where('store_id', $this->id)->get()->first()),
            //'products'=>($this->id == '') ? [] : (ProductResource::collection($this->products)),
            'members'=> UserResource::collection($this->whenLoaded('members')),
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
            'user_id'=> $this->user_id
        ];
    }
}
