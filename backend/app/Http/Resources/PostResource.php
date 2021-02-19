<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // if($this->getFirstMediaUrl()){
        return [
            'id' => $this->id,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'user' => new UserResource($this->user),
            'likes' => $this->likes_total,
            'voted' => $this->hasUserVoted($request->user()),
            'comments_count' => $this->comments_count,
            'files' => $this->media->map(function ($media) {
                return $media->getFullUrl();
            })
        ];
        // }else{
        //     return[
        //         'id'=>$this->id,
        //         'body'=>$this->body,
        //         'created_at'=> $this->created_at->diffForHumans(),
        //         'updated_at' => $this->updated_at->diffForHumans(),
        //         'user' => $this->user,
        //     ];
        // }
    }
}
