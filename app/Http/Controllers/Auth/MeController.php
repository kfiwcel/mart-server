<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\PrivateUserResource;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function me(Request $request): PrivateUserResource
    {
        return new PrivateUserResource($request->user());
    }

    public function getCart(Request $request)
    {
        return new CartResource($request->user()->cart());
    }
}
