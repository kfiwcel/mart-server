<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class,'product_variation_id');
    }

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class,'product_variation_id');
    }
}
