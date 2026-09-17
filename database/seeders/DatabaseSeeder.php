<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $testUser = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        Post::factory()->count(2)->for($testUser)->create();

        User::factory()->count(5)->create()->each(function (User $user) {
            Post::factory()->count(3)->for($user)->create()->each(function (Post $post) use ($user) {
                Comment::factory()->count(2)->for($post)->for($user)->create();
            });
        });
    }
}
