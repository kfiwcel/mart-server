<?php

namespace App\Http\Resources;

use App\Models\Discussion;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title'=>$this->title,
            'author'=>$this->user->name,
            'discussions'=>DiscussionResource::collection($this->discussions)

        ];
    }
}
