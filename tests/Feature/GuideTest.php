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

    /**
     * 編集機能API
     * @return void
     */
    public function test_can_update_edit_data()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user)->put('/api/v1/compose/guides', $this->data());

        $guideId = Guide::first()->id;
        $guideTitle = Guide::first()->title;

        $response = $this->actingAs($this->user)->post('/api/v1/guides/'.$guideId.'/edit', $this->updateData());
        
        $response->assertStatus(201);
        $this->assertEquals($this->updateData()['guide']['title'], Guide::first()->title);
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
                    'overview' => $guide->associate,
                    'content' => $guide->associate,
                ],
                'places' => [
                    'place' => $guide->associate,
                    'detail' => $guide->associate,
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
                'overview' => 'neccessary',
                'content' => 'null'
            ]],
            'place' => [[
                'place' => 'oosaka station',
                'detail' => '',
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
                'overview' => 'neccessary',
                'content' => 'null'
            ]],
            'place' => [[
                'place' => 'kyoto station',
                'detail' => '',
            ]]
        ];
    }


}
