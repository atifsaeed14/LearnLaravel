<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'title'=> $this->title,
            'thumbnail'=> $this->thumbnail,
            'sku'=> $this->sku,
            'tagline'=> $this->tagline,
            'description'=> $this->description,
            'price'=> $this->price,
            'discount'=> $this->discount,
            'status'=> $this->status,
            'featured'=> $this->featured,
            'published'=> $this->published,
            'stock'=> $this->stock,
            'store_id'=> $this->store_id,
            //'stores'=>($this->id == '') ? [] : (StoreResource::collection($this->whenLoaded('stores'))),
            //'products'=>($this->id == '') ? [] : (Product::where('store_id', $this->id)->get()->first()),
           // 'stores'=>($this->store_id == '') ? [] : (StoreResource::collection($this->stores)),
            'members'=> UserResource::collection($this->whenLoaded('storeMembers')),
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
            'user_id'=> $this->user_id
        ];
    }
}
