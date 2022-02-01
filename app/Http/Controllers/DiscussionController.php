<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscussionRequest;
use App\Http\Requests\UpdateDiscussionRequest;
use App\Http\Resources\DiscussionCollection;
use App\Http\Resources\DiscussionResource;
use App\Models\Discussion;

class DiscussionController extends Controller
{
    /**
     * DiscussionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index','show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return DiscussionCollection
     */
    public function index()
    {
        $discussions=Discussion::paginate(3);//
        return new DiscussionCollection($discussions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiscussionRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreDiscussionRequest $request)
    {

        $discussion=Discussion::create([
            'body'=>$request->body,
            'user_id'=>$request->user()->id,
            'topic_id'=>$request->topic_id,
        ]);
        return response()->json([
            'data'=>new DiscussionResource($discussion)
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return new DiscussionResource($discussion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(Discussion $discussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscussionRequest  $request
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateDiscussionRequest $request, Discussion $discussion)
    {
        $this->authorize('update',$discussion);
        $discussion->body=$request->body;
        $discussion->save();
        return response()->json([
            'data'=>new DiscussionResource($discussion)
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Discussion $discussion)
    {
        $this->authorize('destroy',$discussion);
        $discussion->delete();

        return response()->json([
            'data'=>'successful'
        ]);
    }
}
