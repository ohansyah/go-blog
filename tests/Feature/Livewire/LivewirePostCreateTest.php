<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\PostCreate;
use App\Models\Post;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class LivewirePostCreateTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private array $postCreatData;
    private $file;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CategorySeeder::class);
        $this->user = User::factory()->create();
        $this->setPostCreateData();
    }

    public function test_unauthencticate_user_redirect_to_login(): void
    {
        $this->get(route('post.create'))
            ->assertRedirect('/login');
    }

    public function test_post_create_can_be_rendered(): void
    {
        Livewire::test(PostCreate::class, ['categories' => []])
            ->assertStatus(200)
            ->assertSee(__('general.submit'))
            ->assertSee(__('general.back'));
    }

    public function test_post_create_successfull(): void
    {
        $this->actingAs($this->user)
            ->post(route('post.store'), $this->postCreatData)
            ->assertStatus(302);

        $post = Post::latest()->first();

        $this->assertEquals($post->title, $this->postCreatData['title']);
        $this->assertEquals($post->category_id, $this->postCreatData['category_id']);
        $this->assertEquals($post->content, $this->postCreatData['content']);
        $this->assertEquals($post->postTags->count(), 2);
        $this->assertEquals($post->slug, Str::slug($this->postCreatData['title']));

        // Assert the file was stored...
        Storage::disk('public')->assertExists($post->postImage->path);
    }

    private function setPostCreateData()
    {
        Storage::fake('avatars');

        $this->file = UploadedFile::fake()->image('avatar.jpg');
        $this->postCreatData = [
            'title' => 'title name',
            'category_id' => 1,
            'tags' => 'test,tags',
            'content' => 'content',
            'image' => $this->file,
        ];
    }

}
