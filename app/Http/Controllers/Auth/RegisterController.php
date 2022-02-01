<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\PrivateUserRegisterResource;
use App\Http\Resources\PrivateUserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;


class RegisterController extends Controller
{



    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
    }

    public function register(RegisterUserRequest $request): PrivateUserRegisterResource
    {
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        return new PrivateUserRegisterResource($user);
    }
}
