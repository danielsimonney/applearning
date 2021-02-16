<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostsCollectionResource extends ResourceCollection
{

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = PostResource::class;


    public function with($request)
    {
        $topic = $this->collection->first()->topic;
        return [
            'meta' => [
                'topic' => new TopicResource($topic),
            ],
        ];
    }
}
