<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\Post as ResourcesPost;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    //
    public function store(StorePostRequest $request,Topic $topic){
        $post = new Post;
        $post->body = $request->body;
        $post->user()->associate($request->user());
        $topic->posts()->save($post);
        
        $media = collect($request->medias)
            ->map(function ($file) use ($post) {
    
             return $post->addMedia($file)->toMediaCollection();
            });
        // $post->addMediaFromRequest('files')->toMediaCollection();
        // $file=(($request->files->files));
        // dd($file);
        // return response()
        //     ->json(['filetype' => gettype($request->files),'length'=>count($request->files),'body'=>$request->body]);
        //     dump($request->files);
        // foreach($request->files as $file) {
        //     dump($file);
        // }
     
            
        return new ResourcesPost($post);
    }

    public function update(UpdatePostRequest $request,Topic $topic,Post $post){
        $this->authorize('update',$post);
        $post->body = $request->get('body',$post->body);
        $post->save();
        return new ResourcesPost($post);
    }

    public function destroy(Topic $topic,Post $post){
        $this->authorize('destroy',$post);
        $post->delete();
        return response(null,204);
    }

    public function show(Request $request,Topic $topic,Post $post){
        return new ResourcesPost($post);
    }
}
