<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Determine whether anyone (authenticated or guest) can post a comment.
     */
    public function create(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete a comment.
     * Allowed if the user wrote the comment OR owns the post it belongs to.
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id || $user->id === $comment->post->user_id;
    }
}
