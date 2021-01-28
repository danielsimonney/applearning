<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\TopicCreateRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\Tag as ResourcesTag;
use App\Http\Resources\Topic as TopicRessource;
use App\Models\Tag;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::latestFirst()->paginate(5);
        return TopicRessource::collection($topics);
    }

    public function tags()
    {
        $tags = Tag::all();
        return (ResourcesTag::collection($tags));
    }

    public function store(TopicCreateRequest $request)
    {
        $topic = new Topic;
        $topic->title = $request->title;
        $topic->user()->associate($request->user());

        // $tag= Tag::find($request->tag);
        $post = new Post;
        $post->body = $request->body;
        $post->user()->associate($request->user());


        $topic->save();
        $topic->tags()->attach($request->tags);
        $topic->posts()->save($post);

        return new TopicRessource($topic);
    }

    public function show(Topic $topic)
    {
        return new TopicRessource($topic);
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
        return new TopicRessource($topic);
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
