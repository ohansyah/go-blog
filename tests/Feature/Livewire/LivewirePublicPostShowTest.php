<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\PublicPostShow;
use App\Models\Post;
use App\Models\UserPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LivewirePublicPostShowTest extends TestCase
{
    use RefreshDatabase;

    private UserPost $userPost;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userPost = UserPost::factory()->create();
    }

    public function test_public_post_show_can_be_rendered(): void
    {
        Livewire::test(PublicPostShow::class, ['post' => $this->userPost->post])
            ->assertStatus(200);
    }

    public function test_public_post_show_with_id_slug(): void
    {
        $this->get(route('public-post.show', ['id' => $this->userPost->post->id, 'slug' => $this->userPost->post->slug]))
            ->assertStatus(200)
            ->assertSee($this->userPost->post->title);
    }

    public function test_public_post_show_with_id_wrong_slug_redirect(): void
    {
        $this->get(route('public-post.show', ['id' => $this->userPost->post->id, 'slug' => 'wrong-slug']))
            ->assertStatus(301)
            ->assertRedirect(route('public-post.show', ['id' => $this->userPost->post->id, 'slug' => $this->userPost->post->slug]));
    }

    public function test_public_post_show_wrong_id(): void
    {
        $this->get(route('public-post.show', ['id' => 0, 'slug' => 'wrong-slug']))
            ->assertStatus(404);
    }
}
