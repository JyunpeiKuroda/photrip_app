<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BookmarkPlace;
use App\Models\MainBookmark;
use Faker\Generator as Faker;

$factory->define(BookmarkPlace::class, function (Faker $faker) {
    return [
        'main_bookmark_id' => factory(MainBookmark::class)->create()->id,
        'place'            => $faker->city,
        'place_detail'     => $faker->sentence
    ];
});
