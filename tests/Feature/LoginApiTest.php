<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function test_can_login()
    {
        $this->withExceptionHandling();

        $response = $this->post('/api/v1/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(['name' => $this->user->name]);

        $this->assertAuthenticatedAs($this->user);
    }

    public function test_can_logout()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->actingAs($this->user)
            ->post('/api/v1/logout');

        $response->assertStatus(200);
        $this->assertGuest();
    }
}
