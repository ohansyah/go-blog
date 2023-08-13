<?php

namespace App\Http\Livewire;

use App\Services\PostService;
use Livewire\Component;
use Livewire\WithPagination;

class PublicPostIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $request = [
            'category_id' => null,
            'tag_id' => null,
            'per_page' => 10,
        ];

        return view('livewire.public-post-index', [
            'posts' => PostService::index($request),
        ]);
    }
}
