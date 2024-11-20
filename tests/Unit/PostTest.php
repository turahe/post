<?php

declare(strict_types=1);

namespace Turahe\Post\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Turahe\Post\Tests\Models\Post;
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
    public function it_can_force_delete_the_post(): void
    {
        $post = Post::factory()->create();

        $postRepo = new PostRepository($post);
        $deleted = $postRepo->deletePost();

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('posts', []);
    }

    #[Test]
    public function it_cannot_get_the_post(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $postRepo = new PostRepository(new Post);
        $postRepo->getPostBySlug('slug-post');

    }

    #[Test]
    public function it_can_delete_the_post(): void
    {
        $post = Post::factory()->create();

        $postRepo = new PostRepository($post);
        $deletedTrash = $postRepo->trashPost();

        $this->assertTrue($deletedTrash);
        $this->assertSoftDeleted('posts', ['id' => $post->getKey()]);
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

        $postRepo = new PostRepository($postFactory);
        $updated = $postRepo->updatePost($data);

        $post = $postRepo->getPostBySlug($postFactory->slug);

        $this->assertTrue($updated);
        $this->assertEquals($data['title'], $post->title);
        $this->assertEquals($data['description'], $post->description);
        $this->assertEquals($data['subtitle'], $post->subtitle);
        $this->assertEquals($data['type'], $post->type);
    }

    #[Test]
    public function it_can_create_a_post(): void
    {
        if (!Schema::hasTable('posts')) {
            dd('post table not found');
        }
        dd('post table already exists');
        $data = [
            'title' => $this->faker->name,
            'subtitle' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'content' => $this->faker->paragraph,
            'type' => 'post',
        ];

        $post = Post::create($data);

        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals($data['title'], $post->title);
        $this->assertEquals($data['description'], $post->description);
        $this->assertEquals($data['subtitle'], $post->subtitle);
        $this->assertEquals($data['content'], $post->content_raw);
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

        $postRepo = new PostRepository($post);

        $found = $postRepo->getPostBySlug($data['slug']);

        $this->assertInstanceOf(Post::class, $found);
        $this->assertEquals($post['slug'], $found->slug);
        $this->assertEquals($post['title'], $found->title);
    }
}
