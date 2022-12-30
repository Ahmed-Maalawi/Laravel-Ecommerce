<?php

namespace App\Http\Resources\product;

use Illuminate\Http\Resources\Json\JsonResource;
use function PHPUnit\Framework\isEmpty;

class FavouriteItem extends JsonResource
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
            'id' => $this['id'],
            'product' => [
                'id' =>$this['product']['id'],
                'product_name' =>$this['product']['product_name'],
                'price' =>$this['product']['price'],
                'sale_price' =>$this['product']['sale_price'],
                'image' => ( isEmpty($this['product']['image']))? null : $this['product']['image'][0] ,
            ]
        ];
    }
}
