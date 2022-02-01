<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\TopicCollection;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicController extends Controller
{
    /**
     * TopicController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index','show']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return TopicCollection
     */
    public function index(): TopicCollection
    {
        $topics=Topic::paginate(3);//
        return new TopicCollection($topics);

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
     * @param  \App\Http\Requests\StoreTopicRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTopicRequest $request)
    {
        $topic=Topic::create([
            'title'=>$request->title,
            'user_id'=>$request->user()->id,
        ]);
        return response()->json([
            'data'=>new TopicResource($topic)
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return TopicResource
     */
    public function show(Topic $topic): TopicResource
    {
        return new TopicResource($topic);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTopicRequest  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        $this->authorize('update',$topic);
        $topic->title=$request->title;
        $topic->save();
        return response()->json([
            'data'=>new TopicResource($topic)
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('destroy',$topic);
        $topic->delete();

        return response()->json([
            'data'=>'successful'
        ]);
    }
}
