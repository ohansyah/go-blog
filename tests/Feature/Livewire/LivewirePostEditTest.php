<?php

namespace Tests\Feature\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\UserPost;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;


class LivewirePostEditTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private UserPost $userPost;
    private Collection $categories;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CategorySeeder::class);
        $this->user = User::factory()->create();
        $this->userPost = UserPost::factory()->create();
        $this->categories = Category::all();
    }

    public function test_unauthencticate_user_redirect_to_login(): void
    {
        $this->get(route('post.edit', ['post' => $this->userPost->post]))
            ->assertRedirect('/login');
    }

    public function test_post_edit_not_user_post_redirect_to_404(): void
    {
        $this->actingAs($this->user)
            ->get(route('post.edit', ['post' => $this->userPost->post]))
            ->assertStatus(404);
    }

    public function test_post_edit_can_be_rendered(): void
    {
        $this->actingAs($this->userPost->user)
            ->get(route('post.edit', ['post' => $this->userPost->post]))
            ->assertStatus(200)
            ->assertSee(__('general.submit'))
            ->assertSee(__('general.back'))
            ->assertSee($this->userPost->post->title)
            ->assertSee($this->userPost->post->content)
            ->assertViewHas('categories')
            ->assertViewHas('post');
    }

    public function test_post_edit_successfull(): void
    {
        Storage::fake('avatars');

        $this->actingAs($this->userPost->user)
            ->put(route('post.update', ['post' => $this->userPost->post]), [
                'title' => 'title name',
                'category_id' => 1,
                'tags' => 'tag1, tag2',
                'content' => 'content',
                'image' => UploadedFile::fake()->image('avatar.jpg'),
            ])
            ->assertStatus(200);

        $post = Post::find($this->userPost->post_id);

        $this->assertEquals($post->title, 'title name');
        $this->assertEquals($post->category_id, 1);
        $this->assertEquals($post->content, 'content');
        $this->assertEquals($post->postTags->count(), 2);
        $this->assertEquals($post->slug, $this->userPost->post->slug);

        // Assert the file was stored...
        Storage::disk('public')->assertExists($post->postImage->path);
    }

}
