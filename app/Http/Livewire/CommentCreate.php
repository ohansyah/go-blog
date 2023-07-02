<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CommentCreate extends Component
{
    public $postId;

    public function mount($post)
    {
        $this->postId = $post->id;
    }

    public function render()
    {
        return view('livewire.comment-create');
    }
}
