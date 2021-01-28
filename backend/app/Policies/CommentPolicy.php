<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Comment $comment)
    {
        return $user->ownComment($comment);
    }

    public function destroy(User $user, Comment $comment)
    {
        if ($user->ownComment($comment) || $comment->commentable->user->id == $user->id) {
            return true;
        } else {
            return false;
        }
    }
}
