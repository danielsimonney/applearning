<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\TopicCreateRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\TagResource;
use App\Http\Resources\TopicResource;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Tag;

class TopicController extends Controller
{
    public function index($orderBy, $filter = null)
    {

        $topics = Topic::where('title', 'like', "%" . $filter . "%")->withCount('posts')->withCount([
            'likes' => function (Builder $builder) {
                $builder->where('is_liked', true);
            }, "likes as dislikes_count" => function (Builder $builder) {
                $builder->where('is_liked', false);
            }
        ]);

        if ($orderBy == "asc") {
            $p = $topics->orderBy('created_at', 'asc')->paginate(5);
        } else {
            $p = $topics->orderBy('created_at', 'desc')->paginate(5);
        }

        return TopicResource::collection($p);
    }

    public function tags()
    {
        $tags = Tag::all();
        return (TagResource::collection($tags));
    }

    public function store(TopicCreateRequest $request)
    {
        $topic = new Topic;
        $topic->title = $request->title;
        $topic->body = $request->body;
        $topic->user()->associate($request->user());

        // $tag= Tag::find($request->tag);
        $post = new Post;
        $post->body = $request->body;
        $post->user()->associate($request->user());


        $topic->save();
        $topic->tags()->attach($request->tags);
        $topic->posts()->save($post);

        return new TopicResource($topic);
    }

    public function show(Topic $topic)
    {
        return new TopicResource($topic);
    }

    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        if ($request->title) {
            $topic->title = $request->get('title', $topic->title);
        }
        if ($request->tags) {
            $topic->tags()->sync($request->tags);
        }
        $topic->save();
        return new TopicResource($topic);
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('destroy', $topic);
        $topic->delete();
        return response(null, 204);
    }

    public function test(Request $request)
    {
        // $file=$request->file;
        // dump(($file));

        // \Spatie\MediaLibrary\MediaCollections\Models\Media::class;

        // foreach ($file as $key => $value) {
        //     var_dump($value);
        // }
        $post = Post::find(80);
        dump($post->getMedia());
        // $post->addMedia($file)->toMediaCollection();

        //         dd($post->getFirstMediaUrl());
        // <img :src="url" alt="" srcset="">
    }
}
