<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(App\User::class, 3)->create()->each(function ($user) {
            // Seed the relation with 5 purchases
            $post = Post::factory(App\Post::class, 5)->make();
            $user->posts()->saveMany($post);
        });
    }
}
