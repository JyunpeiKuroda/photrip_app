<?php

namespace Tests\Feature;

use App\Models\Guide;
use App\Models\Photo;
use App\Models\Place;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class PhotoApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }


    /**
     * 
     */
    public function test_can_return_valid_json()
    {

        $this->withoutExceptionHandling();
        factory(Place::class)->create()->each(function ($place) {
            $place->photos()->save(factory(Photo::class)->make());
        });
        dd(Photo::all());

        $response = $this->get('/api/v1/photos');

        $photos = Photo::all();
        $expected_data = $photos->map(function ($photo) {
            return [
                'id' => $photo->id,
                'url' => $photo->url,
                'place' => $photo->place
            ];
        })
        ->all();

        $response->assertStatus(200)
            ->assertJsonCount(5,'data')
            ->assertJsonFragment([
                "data" => $expected_data,
            ]);
    }

    /**
     *・ストレージに保存されること
     *
     * @return void
     */
    public function test_can_upload_image_files()
    {
        $this->withoutExceptionHandling();
        Storage::fake('s3');

        factory(Guide::class)->create()->each(function ($guide) {
            $guide->places()->saveMany(factory(Place::class, 3)->make());
        });

        $response = $this->actingAs($this->user)->post('/api/v1/upload/photos', [
            's3' => UploadedFile::fake()->image('s3.jpg'),
        ]);

        $response->assertStatus(201);
        $photo = Photo::first();

        // ファイルが保存されたことをアサート
        Storage::cloud('s3')->assertExists($photo->filename);
    }

    /**
     *・500エラーが返却されること
     *・ストレージに保存されないこと
     * @return void
     */
    public function test_not_save_image_file_when_dberror()
    {
        Schema::drop('photos');

        Storage::fake('s3');

        $response = $this->actingAs($this->user)->post('/api/v1/upload/photos', [
            's3' => UploadedFile::fake()->image('s3.jpg'),
        ]);

        $response->assertStatus(500);
        $this->assertEquals(0, count(Storage::cloud()->files()));

    }
}
