<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Model;
use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        "user_id" => function () {
            return factory(User::class)->create()->id;
        },
        "content" => $faker->sentence,
    ];
});
