<?php

namespace Database\Factories;

use Faker\Generator as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;


$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => $this->faker->name(),
        'last_name' => $this->faker->name(),
        'email' => $this->faker->unique()->safeEmail()
    ];
});

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [];
    }
}
