<?php

namespace Tests\Feature;

use App\BookmarkOverview;
use App\BookmarkPlace;
use App\MainBookmark;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainBookmarkTest extends TestCase
{
    use RefreshDatabase;
    
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

    public function test_post_expexted_json()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/v1/bookmark', $this->data());
        // // dd(MainBookmark::all());
        // // dd(BookmarkPlace::all());
        // dd(BookmarkOverview::all());

        $this->assertCount(1, MainBookmark::all());
        $this->assertCount(1, BookmarkPlace::all());
        $this->assertCount(1, BookmarkOverview::all());
    } 

    public function test_post_bookmark_status_200()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/v1/bookmark', $this->data());

        $response->assertStatus(200);
    } 

    public function data()
    {
        return [
            'title' => '京都旅行',
            'days' => '12日',
            'overviewForm' => [[
                'overview' => '持ち物',
                'content' => '充電コード'
            ]],
            'placeForm' => [[
                'place' => '大阪駅',
                'detail' => 'ここで集合'
            ]]
        ];
    }
}
