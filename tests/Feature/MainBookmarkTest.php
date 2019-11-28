<?php

namespace Tests\Feature;

use App\Models\BookmarkOverview;
use App\Models\BookmarkPlace;
use App\Models\MainBookmark;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class MainBookmarkTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();

    }

    public function test_get_bookmarks_list()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();
        
        $response = $this->get('/api/v1/bookmark');
        // $bookmark = MainBookmark::first();
        // dd($bookmark_main);
        // $response->assertJson([
        //     'data' => [
        //           '*' => [
        //             'bookmark_title' => $bookmark->bookmark_title,
        //             'bookmark_days' => $bookmark->bookmark_days,
        //             '*' => [
        //                 'main_bookmark_id' => $bookmark->main_bookmark_id,
        //                 'overview_title' => $bookmark->overview_title, 
        //                 'overview_content' => $bookmark->overview_content
        //             ],
        //             '*' => [
        //                 'main_bookmark_id' => $bookmark->main_bookmark_id,
        //                 'place' => $bookmark->place,
        //                 'place_detail' => $bookmark->place_detail,
        //             ],
        //         ]
        //     ]
        // ]);
        $response->assertStatus(200);
    }

    // DBに保存できているか
    public function test_can_save_to_db()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/v1/bookmark', $this->data());

        // dd($response);
        $this->assertCount(1, MainBookmark::all());
        $this->assertCount(1, BookmarkPlace::all());
        $this->assertCount(1, BookmarkOverview::all());
    } 

    // 200返答確認
    public function test_post_bookmark_status_200()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/v1/bookmark', $this->data());

        $response->assertStatus(200);
    } 

    // テストリクエストデータ
    public function data()
    {
        return [
            'bookmark'  => [
                'title' => '京都旅行',
                'days'  => '12日',
            ],
            'overviewForm' => [[
                'overview' => '持ち物',
                'content'  => '充電コード'
            ]],
            'placeForm'  => [[
                'place'  => '大阪駅',
                'detail' => 'ここで集合'
            ]]
        ];
    }
}
