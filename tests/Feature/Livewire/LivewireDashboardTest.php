<?php

namespace Tests\Feature\Livewire;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LivewireDashboardTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * A basic feature test example.
     */
    public function test_unauthencticate_user_redirect_to_login(): void
    {
        $this->get('/dashboard')
            ->assertRedirect('/login');
    }

    public function test_dashboard_page_can_be_rendered(): void
    {
        $this->actingAs($this->user)
            ->get('/dashboard')
            ->assertStatus(200);
    }

    public function test_dashboard_load_component(): void
    {
        $this->actingAs($this->user)
            ->get('/dashboard')
            ->assertSeeLivewire('weather')
            ->assertSeeLivewire('welcome');
    }
}
