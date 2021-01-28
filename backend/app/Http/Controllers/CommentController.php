<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\Post as ResourcesPost;
use App\Http\Resources\Topic as ResourcesTopic;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function store(CommentRequest $request, $type, $id)
    {
        $comment = new Comment;
        $comment->user()->associate($request->user());
        $comment->body = $request->body;
        if ($type == "topic") {
            $topic = Topic::all()->find($id);
            $comment = $topic->comments()->save($comment);
            return new ResourcesTopic($topic);
        } elseif ($type == "post") {
            $post = Post::all()->find($id);
            $comment = $post->comments()->save($comment);
            return new ResourcesPost($post);
        } else {
            return new JsonResponse("forbidden type", 404);
        }
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        $comment->body = $request->get('body', $comment->body);
        $comment->save();

        if ($comment->comment_type == "App\Models\Topic") {
            return new ResourcesTopic($comment->comment);
        } else {
            return new ResourcesPost($comment->comment);
        }
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('destroy', $comment);
        $comment->delete();
        return response(null, 204);
    }
}
