<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BookmarkOverview;
use App\Models\MainBookmark;
use Faker\Generator as Faker;

$factory->define(BookmarkOverview::class, function (Faker $faker) {
    return [
        'main_bookmark_id' => function(){
            return factory(MainBookmark::class)->create()->id;
        },
        'overview_title'   => $faker->sentence,
        'overview_content' => $faker->sentence
    ];
});
