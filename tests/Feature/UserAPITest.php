<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAPITest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function test_can_get_userinfo()
    {

        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->user)->get('/api/v1/userinfo');

        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => $this->user->name
            ]);
    }

    public function test_can_return_null_when_guest()
    {

        $this->withoutExceptionHandling();
        $response = $this->get('/api/v1/userinfo');

        $response->assertStatus(200);
        $this->assertEquals("", $response->content());
    }
}
