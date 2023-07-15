<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostEdit extends Component
{
    public $post;
    public $categories;
    public $postTags;

    public function mount($post, $categories)
    {
        $this->post = $post;
        $this->categories = $categories;
        $this->postTags = implode(',', $post->postTags->pluck('tag.name')->toArray());
    }
}
