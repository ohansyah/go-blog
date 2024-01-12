<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\PostShow;
use App\Models\Post;
use App\Models\UserPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LivewirePostShowTest extends TestCase
{
    use RefreshDatabase;

    private UserPost $userPost;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userPost = UserPost::factory()->create();
    }

    public function test_unauthencticate_user_redirect_to_login(): void
    {
        $this->get(route('post.show', ['post' => $this->userPost->post, 'isUserPost' => true]))
            ->assertRedirect('/login');
    }

    public function test_post_show_can_be_rendered(): void
    {
        Livewire::test(PostShow::class, ['post' => $this->userPost->post, 'isUserPost' => false])
            ->assertStatus(200);
    }

    public function test_post_show_can_edit(): void
    {
        $this->actingAs($this->userPost->user)
            ->get(route('post.show', ['post' => $this->userPost->post, 'isUserPost' => true]))
            ->assertSee(__('general.edit'));
    }

    public function test_post_show_can_not_edit(): void
    {
        $this->get(route('post.show', ['post' => $this->userPost->post, 'isUserPost' => false]))
            ->assertDontSee(__('general.edit'));
    }
}
