<?php

namespace App\Http\Livewire;

use App\Services\CommentService;
use Livewire\Component;
use Livewire\WithPagination;

class CommentIndex extends Component
{
    use WithPagination;

    public $postId;
    protected $listeners = ['refreshCommentIndex' => 'refresh'];

    public function mount($post)
    {
        $this->postId = $post->id;
    }

    public function refresh()
    {
        // Add the logic to refresh ComponentB here
    }

    public function render()
    {
        return view('livewire.comment-index', [
            'comments' => CommentService::index($this->postId),
        ]);
    }
}
