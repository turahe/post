<?php

declare(strict_types=1);

namespace Turahe\Post\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Turahe\Post\Models\Post;
use Turahe\Post\Tests\Factories\PostFactory;
use Turahe\Post\Tests\TestCase;

class PostTest extends TestCase
{
    public function test_can_list_all_posts(): void
    {
        $count = 5;
        PostFactory::new()->count($count)->create();

        $this->assertInstanceOf(Collection::class, Post::all());
        $this->assertCount($count, Post::all()); // +1 in the TestCase
    }

    public function test_cannot_get_the_post(): void
    {
        $this->expectException(ModelNotFoundException::class);

        Post::whereSlug('slug-post')->firstOrFail();

    }

    public function test_can_delete_the_post(): void
    {
        $post = PostFactory::new()->createOne();

        $deletedTrash = $post->delete();

        $this->assertTrue($deletedTrash);
        $this->assertSoftDeleted(config('post.tables.posts'));
    }

    public function test_can_update_the_post(): void
    {
        $postFactory = PostFactory::new()->createOne();

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

    public function test_can_create_a_post(): void
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

    public function test_can_find_slug_a_post(): void
    {
        $data = [
            'slug' => 'post-1',
            'title' => 'Post 1',
        ];
        $post = PostFactory::new()->create($data);

        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals($post['slug'], $post->slug);
        $this->assertEquals($post['title'], $post->title);
    }

    public function test_sets_the_record_ordering_on_creation()
    {
        PostFactory::new()->count(5)->create();

        foreach (Post::all() as $index => $post) {
            $this->assertEquals($index + 1, $post->record_ordering);
        }
    }

    public function test_post_was_not_published(): void
    {
        PostFactory::new()->count(2)->create([
            'published_at' => null,
        ]);

        PostFactory::new()->createOne();

        $this->assertCount(2, Post::notPublished()->get());
    }

    public function test_post_was_published(): void
    {
        PostFactory::new()->count(2)->create([
            'published_at' => now(),
        ]);

        PostFactory::new()->createOne([
            'published_at' => null,
        ]);

        $this->assertCount(2, Post::published()->get());
    }
}
