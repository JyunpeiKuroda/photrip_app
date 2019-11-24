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

    public function test_get_bookmarks_list()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();
        
        $bookmark_main = factory(MainBookmark::class)->create()
            ->each(function($bookmark) {
                $bookmark->bookmarkOverviews()->save(
                    factory(BookmarkOverview::class)->make(),
                    factory(BookmarkPlace::class)->make()
                );
            });

        // dd($bookmark_main);
        $this->assertCount(1, BookmarkPlace::all());
        // $this->assertCount(1, BookmarkOverview::all());
        // $this->assertCount(1, BookmarkPlace::all());

        // $response = $this->get('/api/v1/bookmark');
        
        // // $response->assertJson([
        // //     'data' => [
        // //         'bookmark_title' => $bookmark_main->bookmark_title,
        // //         'bookmark_days' => $bookmark_main->bookmark_days,
        // //         'overviewForm' => [
        // //             'main_bookmark_id' => $bookmark_overview->main_bookmark_id,
        // //             'overview_title' => $bookmark_overview->overview_title, 
        // //             'overview_content' => $bookmark_overview->overview_content
        // //         ],
        // //         'placeForm' => [
        // //             'main_bookmark_id' => $bookmark_place->main_bookmark_id,
        // //             'place' => $bookmark_place->place,
        // //             'place_detail' => $bookmark_place->place_detail,
        // //         ],
        // //     ]
        // // ]);
        // $response->assertStatus(200);
        // $response->assertJson([
        //     'name' => 'mama'
        // ]);
    }

    // DBに保存できているか
    public function test_can_save_to_db()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/v1/bookmark', $this->data());

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
