<?php

declare(strict_types=1);

namespace Turahe\Post\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use PHPUnit\Framework\Attributes\Test;
use Turahe\Post\Models\Content;
use Turahe\Post\Tests\Models\Dummy;
use Turahe\Post\Tests\Models\User;
use Turahe\Post\Tests\TestCase;

class ContentTest extends TestCase
{
    protected $testModel;

    public function setUp(): void
    {
        parent::setUp();
        $this->testModel = Dummy::create(['name' => 'Dummy Dummy Dummy Dummy']);
    }

    #[Test]
    public function it_can_list_all_contents(): void
    {
        $count = 5;
        Content::factory()->count($count)->create([
            'model_id' => $this->testModel->getKey(),
            'model_type' => $this->testModel->getMorphClass(),
        ]);

        $this->assertInstanceOf(Collection::class, Content::all());
        $this->assertCount($count, Content::all()); // +1 in the TestCase
    }

    #[Test]
    public function it_can_delete_the_content(): void
    {
        $content = Content::factory()->create([
            'model_id' => $this->testModel->getKey(),
            'model_type' => $this->testModel->getMorphClass(),
        ]);

        $deletedTrash = $content->delete();

        $this->assertTrue($deletedTrash);
        $this->assertSoftDeleted('contents');
        $this->assertNotNull($content->deleted_at);
    }

    #[Test]
    public function it_can_delete_the_content_of_user(): void
    {
        $user1 = User::create([]);
        $this->actingAs($user1);

        $content = Content::factory()->create([
            'model_id' => $this->testModel->getKey(),
            'model_type' => $this->testModel->getMorphClass(),
        ]);

        $user2 = User::create([]);
        $this->actingAs($user2);
        $deletedTrash = $content->delete();

        $this->assertTrue($deletedTrash);
        $this->assertSoftDeleted('contents');
        $this->assertNotNull($content->deleted_at);
        $this->assertEquals($user1->getKey(), $content->created_by);
        $this->assertEquals($user2->getKey(), $content->deleted_by);
    }

    #[Test]
    public function it_can_update_the_content(): void
    {
        $contentFactory = Content::factory()->create([
            'model_id' => $this->testModel->getKey(),
            'model_type' => $this->testModel->getMorphClass(),
        ]);

        $contentRaw = $this->faker->paragraph();
        $markdown = new GithubFlavoredMarkdownConverter;

        $data = [
            'content_raw' => $contentRaw,
            'content_html' => $markdown->convert($contentRaw),
        ];

        $updated = $contentFactory->update($data);

        $content = Content::find($contentFactory->getKey());

        $this->assertTrue($updated);
        $this->assertEquals($data['content_raw'], $content->content_raw);
        $this->assertEquals($data['content_html'], $content->content_html);
    }

    #[Test]
    public function it_can_update_the_content_of_user(): void
    {
        $user1 = User::create([]);
        $this->actingAs($user1);
        $contentFactory = Content::factory()->create([
            'model_id' => $this->testModel->getKey(),
            'model_type' => $this->testModel->getMorphClass(),
        ]);

        $contentRaw = $this->faker->paragraph();
        $markdown = new GithubFlavoredMarkdownConverter;

        $data = [
            'content_raw' => $contentRaw,
            'content_html' => $markdown->convert($contentRaw),
        ];

        $user2 = User::create([]);
        $this->actingAs($user2);
        $updated = $contentFactory->update($data);

        $content = Content::find($contentFactory->getKey());

        $this->assertTrue($updated);
        $this->assertEquals($data['content_raw'], $content->content_raw);
        $this->assertEquals($data['content_html'], $content->content_html);
        $this->assertEquals($user1->getKey(), $content->created_by);
        $this->assertEquals($user2->getKey(), $content->updated_by);
    }

    #[Test]
    public function it_can_create_a_content(): void
    {

        $contentRaw = $this->faker->paragraph();
        $markdown = new GithubFlavoredMarkdownConverter;
        $data = [
            'model_id' => $this->testModel->getKey(),
            'model_type' => $this->testModel->getMorphClass(),
            'content_raw' => $contentRaw,
            'content_html' => $markdown->convert($contentRaw),
        ];

        $content = Content::create($data);

        $this->assertInstanceOf(Content::class, $content);
        $this->assertEquals($data['model_id'], $content->model_id);
        $this->assertEquals($data['model_type'], $content->model_type);
        $this->assertEquals($data['content_raw'], $content->content_raw);
        $this->assertEquals($data['content_html'], $content->content_html);
    }

    #[Test]
    public function it_can_create_a_content_of_user(): void
    {

        $user = User::create([]);
        $this->actingAs($user);
        $contentRaw = $this->faker->paragraph();
        $markdown = new GithubFlavoredMarkdownConverter;
        $data = [
            'model_id' => $this->testModel->getKey(),
            'model_type' => $this->testModel->getMorphClass(),
            'content_raw' => $contentRaw,
            'content_html' => $markdown->convert($contentRaw),
        ];

        $content = Content::create($data);

        $this->assertInstanceOf(Content::class, $content);
        $this->assertEquals($data['model_id'], $content->model_id);
        $this->assertEquals($data['model_type'], $content->model_type);
        $this->assertEquals($data['content_raw'], $content->content_raw);
        $this->assertEquals($data['content_html'], $content->content_html);
        $this->assertEquals($user->getKey(), $content->created_by);
        $this->assertEquals($user->getKey(), $content->updated_by);
    }

    #[Test]
    public function it_can_find_slug_a_content(): void
    {

        $content = Content::factory()->create($data = [
            'model_id' => $this->testModel->getKey(),
            'model_type' => $this->testModel->getMorphClass(),
        ]);

        $this->assertInstanceOf(Content::class, $content);
        $this->assertEquals($data['model_id'], $content->model_id);
        $this->assertEquals($data['model_type'], $content->model_type);
    }
}
