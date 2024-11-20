<?php

declare(strict_types=1);

namespace Turahe\Post\Tests\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use League\CommonMark\Exception\CommonMarkException;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Turahe\Post\Tests\Models\Content;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    protected $model = Content::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     * @throws CommonMarkException
     */
    public function definition(): array
    {
        $content = $this->faker->paragraph();
        $markdown = new GithubFlavoredMarkdownConverter;

        return [
            'content_raw' => $this->faker->paragraph(),
            'content_html' => $markdown->convert($content),
        ];
    }
}
