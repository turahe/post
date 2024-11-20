<?php

declare(strict_types=1);

namespace Turahe\Post\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit\Framework\Attributes\Test;
use Turahe\Post\Models\Post;
use Turahe\Post\Tests\TestCase;

class PostTest extends TestCase
{
    #[Test]
    public function it_can_list_all_posts(): void
    {
        $count = 5;
        Post::factory()->count($count)->create();

        $this->assertInstanceOf(Collection::class, Post::all());
        $this->assertCount($count, Post::all()); // +1 in the TestCase
    }

    #[Test]
    public function it_cannot_get_the_post(): void
    {
        $this->expectException(ModelNotFoundException::class);

        Post::whereSlug('slug-post')->firstOrFail();

    }

    #[Test]
    public function it_can_delete_the_post(): void
    {
        $post = Post::factory()->create();

        $deletedTrash = $post->delete();

        $this->assertTrue($deletedTrash);
        $this->assertDatabaseMissing('posts');
    }

    #[Test]
    public function it_can_update_the_post(): void
    {
        $postFactory = Post::factory()->create();

        $data = [
            'title' => $this->faker->name,
            'subtitle' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'type' => 'post',
        ];

        $updated = $postFactory->update($data);

        $post = Post::whereSlug($postFactory->slug)->first();

        $this->assertTrue($updated);
        $this->assertEquals($data['title'], $post->title);
        $this->assertEquals($data['description'], $post->description);
        $this->assertEquals($data['subtitle'], $post->subtitle);
        $this->assertEquals($data['type'], $post->type);
    }

    #[Test]
    public function it_can_create_a_post(): void
    {

        $data = [
            'title' => $this->faker->name,
            'subtitle' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'type' => 'post',
        ];

        $post = Post::create($data);

        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals($data['title'], $post->title);
        $this->assertEquals($data['description'], $post->description);
        $this->assertEquals($data['subtitle'], $post->subtitle);
        $this->assertEquals($data['type'], $post->type);
    }

    #[Test]
    public function it_can_find_slug_a_post(): void
    {
        $data = [
            'slug' => 'post-1',
            'title' => 'Post 1',
        ];
        $post = Post::factory()->create($data);

        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals($post['slug'], $post->slug);
        $this->assertEquals($post['title'], $post->title);
    }
}
