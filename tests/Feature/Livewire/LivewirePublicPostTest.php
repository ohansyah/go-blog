<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\PublicPostIndex;
use App\Models\Post;
use App\Models\UserPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Services\PostService;

class LivewirePublicPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_post_empty(): void
    {
        Livewire::test(PublicPostIndex::class)
            ->assertStatus(200)
            ->assertSee(__('No Post found'));
    }

    public function test_public_post_not_empty(): void
    {
        UserPost::factory()->create();
        
        $posts = PostService::index([]);

        Livewire::test(PublicPostIndex::class, ['posts' => $posts])
            ->assertSee($posts->first()->title);

    }

    public function test_public_post_pagination(): void
    {
        UserPost::factory()->count(15)->create();

        $posts = PostService::index([]);

        Livewire::test(PublicPostIndex::class, ['posts' => $posts])
            ->assertSee($posts->first()->title)
            ->assertSee($posts->last()->title)
            ->assertSee('Previous')
            ->assertSee('Next')
            ->assertDontSee('No Post found')
            ->assertViewHas('posts', function ($posts) {
                return $posts->count() === 10;
            });

    }

}
