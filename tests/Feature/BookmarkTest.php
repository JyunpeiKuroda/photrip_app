<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookmarkTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_post_bookmark_json()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/v1/bookmark', $this->data());
        $response->assertStatus(200);
    } 

    public function data()
    {
        return [
            [ 'title'=> "dsaf", 'days'=> "dfsd" ], 
            [
                [ 'overview'=> "dfsgd", 'content'=> "dsafsgd" ]
            ],
            [
                [ 'place'=> "dsfsd", 'detail'=> "sadf" ]
            ]
        ];
    }
}
