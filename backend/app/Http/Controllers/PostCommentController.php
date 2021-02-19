<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(CommentRequest $request, $type, $id)
    {
        $comment = new Comment;
        $comment->user()->associate($request->user());
        $comment->body = $request->body;
        $post = Post::all()->find($id);
        $comment = $post->comments()->save($comment);
        return new PostResource($post);
    }

    public function index(Post $post)
    {
        $comments = $post->comments()->with('user')->paginate(5);
        return CommentResource::collection($comments);
    }
}
