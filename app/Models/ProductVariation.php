<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $guarded = [];
    //将字段映射成对象
    protected $casts = [
        'specification' => 'object'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function desc()
    {
        $desc = $this->product->name . ':';
        foreach ($this->specification as $item) {
            $desc .= $item . ' ';
        }
        return $desc;
    }
}
