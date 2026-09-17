<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    private array $techComments = [
        'Great breakdown. Did you run into any issues with prepared statement pinning during transaction pooling?',
        'We implemented the partial index approach last quarter—zero unique constraint violations since.',
        'Agree on Inertia for CRUD. Where it gets tricky is offline-first mobile sync later on.',
        'Solid points on static analysis. Level 8 is painful to introduce on legacy codebases though.',
        'Can you share your configuration snippet for the timeout fallbacks?',
    ];

    public function definition(): array
    {
        return [
            'post_id' => Post::factory(),
            'user_id' => fake()->boolean(80) ? User::factory() : null,
            'comment' => fake()->randomElement($this->techComments),
        ];
    }
}
