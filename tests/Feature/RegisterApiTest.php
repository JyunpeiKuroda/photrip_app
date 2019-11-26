<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function test_can_create_new_user()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/v1/register', $this->data());

        $user = User::first();
        $this->assertEquals('testname', $user->name);

        $response
            ->assertStatus(201)
            ->assertJson(['name' => $user->name]);
    }

    public function data()
    {
        return [
            'name' => 'testname',
            'email' => 'sample@gmail.com',
            'password' => '11223344',
        ];
    }
}
