<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    $candidate_ids = App\User::where('candidate', 1)->where('active', 1)->pluck('id');
    $voter_ids = App\User::where('active', 1)->pluck('id');
    return [
        'voter_id' => $faker->randomElement($voter_ids),
        'candidate_id' => $faker->randomElement($candidate_ids),
        'valid' => 1
    ];
});
