<?php

declare(strict_types=1);

namespace Turahe\Post\Databases\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Turahe\Post\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Turahe\Post\Models\Post>
 */
class PostFactory extends Factory
{

    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['blog', 'article', 'book']);

        return [
            'title' => $this->faker->sentence,
            'subtitle' => $this->faker->sentence,
            'description' => $this->faker->paragraph(2),
            'type' => $type,
            'is_sticky' => $this->faker->boolean,
            'published_at' => $this->faker->dateTimeBetween('-2 months'),
            'language' => $this->faker->randomElement(['en', 'id']),
            'layout' => $type,
        ];
    }
}
