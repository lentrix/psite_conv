<?php

use Faker\Generator as Faker;

$factory->define(\App\Nomination::class, function (Faker $faker) {
    return [
        'nominee' => $faker->numberBetween(10,25),
        'by'=> $faker->numberBetween(1,30)
    ];
});
