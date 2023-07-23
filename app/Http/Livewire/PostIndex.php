<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Tag;
use App\Services\PostService;
use Livewire\Component;
use Livewire\WithPagination;

class PostIndex extends Component
{
    use WithPagination;

    public $categories;
    public $tags;

    public $optionCategory;
    public $optionTag;

    public function mount()
    {
        $this->categories = Category::select('id', 'name')->get();
        $this->tags = Tag::select('id', 'name')->get();
    }

    public function updatedOptionCategory($value)
    {
        $this->optionCategory = $value;
    }

    public function updatedOptionTag($value)
    {
        $this->optionTag = $value;
    }

    public function render()
    {
        $request = [
            'category_id' => $this->optionCategory ?? null,
            'tag_id' => $this->optionTag ?? null,
            'per_page' => 10,
        ];

        return view('livewire.post-index', [
            'posts' => PostService::index($request),
        ]);
    }
}
