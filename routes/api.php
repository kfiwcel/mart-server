<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', 'App\Http\Controllers\CategoryController');
Route::apiResource('products', 'App\Http\Controllers\ProductController');
Route::apiResource('topics', 'App\Http\Controllers\TopicController');
Route::apiResource('discussions', 'App\Http\Controllers\DiscussionController');
Route::apiResource('likes', 'App\Http\Controllers\LikeController');

Route::apiResource('carts', 'App\Http\Controllers\CartController');
Route::apiResource('addresses', 'App\Http\Controllers\AddressController');//收货地址

Route::post('carts/empty','App\Http\Controllers\CartController@empty');//清空购物车
Route::post('address/select','App\Http\Controllers\AddressController@select');//选择收货地址

Route::group(['prefix'=>'auth'],function (){
    Route::post('register','App\Http\Controllers\Auth\RegisterController@register');
    Route::post('login','App\Http\Controllers\Auth\LoginController@login');
    Route::post('logout','App\Http\Controllers\Auth\LogoutController@logout');
    Route::get('me','App\Http\Controllers\Auth\MeController@me');
    Route::get('cart','App\Http\Controllers\Auth\MeController@getCart');
});


//test
Route::get('/users1',function (){
    $users=User::get();
    return \App\Http\Resources\UserResource::collection($users);
});

Route::get('/users2',function (){
    $users=User::get();
    return new \App\Http\Resources\UserCollection($users);
});


Route::get('/users/{user}',function (User $user){
        return new \App\Http\Resources\UserResource($user);
});


Route::get('/test', function () {
    $product = \App\Models\Product::find(107);
    $product->update([
        'specification' => [
            'color' => [
                'name'=>'颜色',
                'options'=>['红色', '蓝色', '绿色'],
                'default'=>'红色'
            ],
            'memory' => [
                'name'=>'内存',
                'options'=>['8GB&128GB', '8GB&256GB','16GB&128GB','16GB&256GB'],
                'default'=>'8GB&256GB'

            ]

        ]
    ]);
    /*
    $product->variations()->saveMany([
        \App\Models\ProductVariation::create([
            'specification' => [
                'color' => '红色',
                'memory' => '8GB&128GB'
            ],
            'stock' => 1000,
            'price' => 200000,
        ]),

        \App\Models\ProductVariation::create([
            'specification' => [
                'color' => '红色',
                'memory' => '8GB&256GB'
            ],
            'stock' => 1000,
            'price' => 240000,
        ]),


        \App\Models\ProductVariation::create([
            'specification' => [
                'color' => '蓝色',
                'memory' => '16GB&256GB'
            ],
            'stock' => 1200,
            'price' => 300000,
        ]),

        \App\Models\ProductVariation::create([
            'specification' => [
                'color' => '蓝色',
                'memory' => '8GB&128GB'
            ],
            'stock' => 1200,
            'price' => 220000,
        ]),

        \App\Models\ProductVariation::create([
            'specification' => [
                'color' => '蓝色',
                'memory' => '8GB&256GB'
            ],
            'stock' => 1200,
            'price' => 240000,
        ]),
    ]);
    */

    dump($product->variations);
});
