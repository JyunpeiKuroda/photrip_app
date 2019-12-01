<?php

namespace Tests\Feature;

use App\Models\Guide;
use App\Models\Overview;
use App\Models\Place;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GuideTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * 削除確認
     *
     * @return void
     */
    public function test_can_delete_guide()
    {
        $this->actingAs($this->user)->post('/api/v1/compose/guides', $this->data());

        $guideId = Guide::first()->id;
        $response = $this->actingAs($this->user)->delete('/api/v1/guides/'.$guideId);

        $response->assertStatus(200);
        $this->assertCount(0, Guide::all());
    }

    public function test_can_get_image_file_from_s3()
    {
        $this->actingAs($this->user)->post('/api/v1/compose/guides', $this->updateData());
        dd(Place::all());
        $response = $this->actingAs($this->user)->get('/api/v1/photos');
        
        

    }

    /**
     * 編集機能API
     * @return void
     */
    public function test_can_update_edit_data()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user)->post('/api/v1/compose/guides', $this->data());
        
        $guideId = Guide::first()->id;
        $guideTitle = Guide::first()->title;

        $response = $this->actingAs($this->user)->put('/api/v1/guides/'.$guideId.'/edit', $this->updateData());

        $response->assertStatus(201);
        $this->assertEquals($this->updateData()['overview'][0]['overview'], Guide::first()->overviews());
    }

    /** 
     * 詳細情報取得APIテスト
     */
    public function test_can_return_json_edit_data()
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs($this->user)->post('/api/v1/compose/guides', $this->data());
        $this->actingAs($this->user)->post('/api/v1/compose/guides', $this->data());
        $this->actingAs($this->user)->post('/api/v1/compose/guides', $this->data());

        $guideId = Guide::first()->id;

        $response = $this->actingAs($this->user)->get('/api/v1/edit/guides/'.$guideId);

        $guides = Guide::with(['places', 'overviews'])->get();

        $expected_data = $guides->map(function ($guide) {
            return [
                'id' => $guide->id,
                'title' => $guide->title,
                'days' => $guide->days,
                'overviews' => [
                    'overview' => $guide->overviews()->overview,
                    'content' => $guide->overviews()->content,
                ],
                'places' => [
                    'place' => $guide->palces()->place,
                    'detail' => $guide->palces()->detail,
                    'schedule' => $guide->palces()->schedule,
                    'time' => $guide->palces()->time,
                ],
            ];
        })
        ->all();

        $response->assertStatus(200)
            ->assertJsonFragment([
                'data' => $expected_data
            ]);

    }

    /**
     *  一覧なのでGuideのデータ + Username
     */
    public function test_can_return_valid_guide_json()
    {
        $this->withoutExceptionHandling();

        factory(Guide::class, 5)->create();

        $response = $this->get('/api/v1/guides');

        $guides = Guide::with(['user'])->orderBy('created_at', 'desc')->get();

        $expected_data = $guides->map(function ($guide) {
            return [
                'id' => $guide->id,
                'title' => $guide->title,
                'days' => $guide->days,
                'user' => [
                    'name' => $guide->user->name,
                ],
            ];
        })
        ->all();

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonFragment([
            'data' => $expected_data
        ]);
    }

    //**登録テスト */
    public function test_can_save_guide_data()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->user)->post('/api/v1/compose/guides', $this->data());
        $this->assertCount(1, Guide::all());
        $this->assertCount(1, Place::all());
        $this->assertCount(1, Overview::all());
        $response->assertStatus(201);
    }

    //**post用データ */
    public function data() 
    {
        return [
            'guide' => [
                'title' => 'kyoto trip',
                'days' => '12days'
            ],
            'overview' => [[
                'id' => '1',
                'overview' => 'neccessary',
                'content' => 'null'
            ],[
                'id' => '2',
                'overview' => 'neccessary',
                'content' => 'null'
            ]],
            'place' => [[
                'id' =>'1',
                'place' => 'oosaka station',
                'detail' => '',
                'schedule' => '2019-11-10',
                'time' => '10:00'
            ]]
        ];
    }

    public function updateData()
    {
        return [
            'guide' => [
                'title' => 'oosaka',
                'days' => '5days'
            ],
            'overview' => [[
                'id' =>'1',
                'overview' => 'neccessary',
                'content' => 'asd'
            ],[
                'id' =>'2',
                'overview' => 'neccessary2',
                'content' => 'asdf'
            ],[
                'id' => '3',
                'overview' => 'neccessary',
                'content' => 'null'
            ]],
            'place' => [[
                'id' =>'1',
                'place' => 'kyoto station',
                'detail' => 'adsfg',
                'schedule' => '2019-11-10',
                'time' => '10:00',
                'file_path' => 'uploads/img_5de0f75749d3e.png'
            ]]
        ];
    }


}
