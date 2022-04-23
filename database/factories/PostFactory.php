<?php

namespace Database\Factories;

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $this->faker->title(),
        'description' => $this->faker->paragraph(),
        'user_id' => $this->factory(App\User::class),
    ];
});

