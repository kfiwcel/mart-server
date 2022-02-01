<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartAddItemRequest;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(CartAddItemRequest $request)
    {
        $cart=$request->user()->cart();//获取用户的活动购物车
        $cart->syncProducts($request->products);

    }

    public function empty(Request $request)
    {
        $cart=$request->user()->cart();//获取用户的活动购物车
        $cart->empty();
    }
}
