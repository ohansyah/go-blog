<?php

namespace App\Http\Livewire;

use App\Services\PostService;
use Livewire\Component;
use Livewire\WithPagination;

class PostIndex extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.post-index', [
            'posts' => (new PostService)->index(10),
        ]);
    }
}
