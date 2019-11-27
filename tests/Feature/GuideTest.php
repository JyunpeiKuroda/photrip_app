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
     *  一覧なのでGuideのデータ + Username
     * 
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
        dd(json_encode($this->data()));
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->user)->post('/api/v1/guides', $this->data());

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
                'title' => 'title',
                'days' => 'days'
            ],
            'overview' => [[
                'overview' => null,
                'content' => null
            ]],
            'place' => [[
                'place' => null,
                'detail' => null,
            ]]
        ];
    }


}
