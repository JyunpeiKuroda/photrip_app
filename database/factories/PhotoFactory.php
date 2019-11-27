<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Photo;
use App\Models\Place;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'place_id' => factory(Place::class)->create()->id,
        'filename' => str_random(12) . '.jpg',
    ];
});
