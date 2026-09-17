<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    private array $techArticles = [
        [
            'title' => 'Scaling PostgreSQL Connection Pooling with PgBouncer in Laravel',
            'content' => "When horizontal scaling hits your relational database, TCP handshake overhead and active connection limits become bottlenecks.\n\n### Why PgBouncer Helps\nBy sitting in front of PostgreSQL in transaction-pooling mode, client connections are multiplexed across a smaller pool of backend connections.\n\n* Lower memory footprint per DB process\n* Predictable query latency under load\n* Seamless integration with Laravel's database config",
        ],
        [
            'title' => 'Why We Swapped REST for Inertia.js Monoliths on Core Products',
            'content' => "API-first decouples teams theoretically, but introduces schema drift, dual validation duplication, and network waterfall pain points for CRUD-heavy UI.\n\n### The Monolithic Advantage\nSharing DTO/Form Request validation rules directly with Vue 3 props eliminates integration lag and cuts feature delivery time in half.",
        ],
        [
            'title' => 'Enforcing Strict Type Safety with Larastan Level 8+',
            'content' => "PHP's gradual typing is a double-edged sword without static analysis. Moving from mixed returns to explicit Eloquent relationship return types (`BelongsTo`, `HasMany`) catches N+1 and null-pointer bugs at compile time.",
        ],
        [
            'title' => 'Partial Unique Indexes in PostgreSQL for Soft-Delete Hygiene',
            'content' => "Standard UNIQUE constraints break when soft deletes (`deleted_at`) are introduced. PostgreSQL partial indexes solve this cleanly:\n\n```sql\nCREATE UNIQUE INDEX posts_slug_unique ON posts (slug) WHERE deleted_at IS NULL;\n```",
        ],
    ];

    public function definition(): array
    {
        $article = fake()->randomElement($this->techArticles);

        return [
            'user_id' => User::factory(),
            'title' => $article['title'] . ' ' . fake()->optional(0.3)->numberBetween(2, 9), // adds light variance
            'content' => $article['content'],
        ];
    }
}
