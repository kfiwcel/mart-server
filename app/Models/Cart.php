<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Cart extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function syncProducts($products)
    {
        foreach ($products as $variation){
            $filter=[
                'product_variation_id'=>$variation['product_variation_id']
            ];
            $cartItem=$this->cartItems()->updateOrCreate($filter,Arr::only($variation,['product_variation_id','quantity']));
            $cartItem->price=$cartItem->variation->price*$cartItem->quantity;
            $cartItem->save();
        }
        $variations=Arr::pluck($products,['product_variation_id']);
        foreach ($this->cartItems as $item){
            if(!in_array($item->product_variation_id,$variations,true)){
                $item->delete();

            }
        }

    }
    //清空购物车
    public function empty()
    {
        $this->cartItems()->delete();
    }
    // 购物车商品总价计算
    public function total()
    {
        return $this->cartItems->sum('price');
    }


    public function oder()
    {
        return $this->hasOne(Order::class);
    }
}
