<?php

namespace App\Http\Livewire;

use App\Services\CommentService;
use Livewire\Component;

class CommentIndex extends Component
{
    public $postId;
    public $comments;

    public function mount($post)
    {
        $this->postId = $post->id;
        $this->comments = CommentService::index($post->id);
    }

    public function render()
    {
        return view('livewire.comment-index');
    }
}
