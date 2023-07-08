<?php

namespace App\Http\Livewire;

use App\Services\CommentService;
use Livewire\Component;
use Livewire\WithPagination;

class CommentIndex extends Component
{
    use WithPagination;

    public $postId;

    public function mount($post)
    {
        $this->postId = $post->id;
    }

    public function render()
    {
        return view('livewire.comment-index', [
            'comments' => CommentService::index($this->postId),
        ]);
    }
}
