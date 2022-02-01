<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\PrivateUserRegisterResource;
use App\Http\Resources\PrivateUserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'errors' => [
                    'email' => '无法通过密码验证'
                ]
            ], 422);
        }

        $user = $request->user();
        $access_token = $user->createToken('Coding10')->accessToken;

        return (new PrivateUserResource($user))->additional([
            'meta' => [
                'token' => $access_token
            ]
        ]);
    }



}
