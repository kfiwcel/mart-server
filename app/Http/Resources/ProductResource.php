<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'slug'=>$this->slug,
            'desc'=>$this->description,
            'price'=>$this->price,
            'image'=>$this->poster,

            'brand'=>$this->brand,
            'category'=>$this->category->name,
            'category_id'=>$this->category_id
        ];
    }
}
