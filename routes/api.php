<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', 'App\Http\Controllers\CategoryController');
Route::apiResource('products', 'App\Http\Controllers\ProductController');
Route::get('/test',function (){
    $product=\App\Models\Product::first();
    $product->update([
        'specification'=>[
            'color'=>['red','blue','green'],
            'memory'=>['8X64','8x128'],
            'size'=>1
        ]
    ]);
    dump($product);
});
