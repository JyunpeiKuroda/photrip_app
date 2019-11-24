<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BookmarkPlace;
use App\MainBookmark;
use Faker\Generator as Faker;

$factory->define(BookmarkPlace::class, function (Faker $faker) {
    return [
        'main_bookmark_id' => factory(MainBookmark::class),
        'place'            => $faker->city,
        'place_detail'     => $faker->sentence
    ];
});