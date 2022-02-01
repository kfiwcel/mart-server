<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLikeRequest;
use App\Models\Discussion;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    /**
     * LikeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function store(Request $request)
    {
        $user=$request->user();
        $likeable_user_id=Discussion::find($request->likeable_id)->user_id;

        if ($user->id===$likeable_user_id) {
            return response([
                'data'=>'您不能对自己的内容点赞！'
            ],401);

        }
        $likeable=$request->likeable_type::findOrFail($request->likeable_id);

        if ($user->hasLiked($likeable)) {
            return response([
                'data'=>'您不能对同一内容重复点赞！'
            ],409);
        }

        Like::firstOrCreate([
            'user_id'=>$user->id,
            'likeable_type'=>$request->likeable_type,
            'likeable_id'=>$request->likeable_id
        ]);
        return response(null,204);


    }

    public function destroy(Request $request,Like $like)
    {
        $user=$request->user();
        if ($user->id!==$like->user_id) {
            return response()->json([
                'data'=>'fail'
            ],409);
        }
        $like->delete();
        return response()->json([
            'data'=>'successful'
        ],200);
    }
}
