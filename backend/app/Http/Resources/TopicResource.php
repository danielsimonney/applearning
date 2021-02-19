<?php

namespace App\Http\Resources;

use App\Models\Tag;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'posts_count' => $this->posts_count,
            'likes' => $this->likes_total,
            'voted' => $this->hasUserVoted($request->user()),
            'tags' => TagResource::collection($this->tags),
            'user' => new UserResource($this->user),
            'files' => $this->media->map(function ($media) {
                return $media->getFullUrl();
            })
        ];
    }
}
