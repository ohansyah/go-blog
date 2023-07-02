<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public static function index($postId)
    {
        $comments = Comment::with(['user'])
            ->where('post_id', $postId)
            ->whereNull('parent_id')
            ->get();

        return $comments;
    }
}
