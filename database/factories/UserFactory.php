<?php

namespace Database\Factories;
use App\Models\User;
use Faker\Generator as Faker;


$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $this->faker->name(),
        'last_name' => $this->faker->name(),
        'email' => $this->faker->unique()->safeEmail()
    ];
});
