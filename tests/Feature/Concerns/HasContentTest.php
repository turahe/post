<?php

declare(strict_types=1);

namespace Turahe\Post\Tests\Feature\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Turahe\Post\Models\Content;
use Turahe\Post\Tests\Factories\ContentFactory;
use Turahe\Post\Tests\Models\Dummy;
use Turahe\Post\Tests\TestCase;

class HasContentTest extends TestCase
{
    protected $testModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testModel = Dummy::create(['name' => 'Dummy Dummy Dummy Dummy']);

    }

    public function test_provides_a_contents_relation(): void
    {
        $this->assertInstanceOf(MorphMany::class, $this->testModel->contents());
        $this->assertInstanceOf(Collection::class, $this->testModel->contents);
    }

    public function test_can_model_has_relation_with_contents(): void
    {
        $this->testModel->contents()->saveMany(ContentFactory::new()->count(3)->make());
        $this->assertInstanceOf(MorphMany::class, $this->testModel->contents());
        $this->assertInstanceOf(Collection::class, $this->testModel->contents);
        $this->assertInstanceOf(Content::class, $this->testModel->getContent());

    }

    public function test_can_model_has_create_with_contents(): void
    {
        $markdown = new GithubFlavoredMarkdownConverter();

        $data = ['content' => 'this is contents'];
        $content = $this->testModel->setContents($data['content']);
        $renderedContent = $markdown->convert($data['content'])->getContent();

        $this->assertInstanceOf(Content::class, $content);
        $this->assertEquals($data['content'], $this->testModel->content_raw);
        $this->assertEquals($renderedContent, $this->testModel->content_html);

        $this->assertDatabaseHas('contents', [
            'content_raw' => $data['content'],
            'content_html' => $renderedContent,
            'model_id' => $this->testModel->getKey(),
            'model_type' => $this->testModel->getMorphClass(),
        ]);

    }

    public function test_can_model_delete_and_all_contents(): void
    {
        ContentFactory::new()->count(3)->create([
            'model_id' => $this->testModel->getKey(),
            'model_type' => $this->testModel->getMorphClass(),
        ]);
        $deleted = $this->testModel->delete();
        $this->assertTrue($deleted);

        $this->assertSoftDeleted(
            'contents',
            [
                'model_type' => $this->testModel->getMorphClass(),
                'model_id' => $this->testModel->getKey(),
            ]
        );

        Content::withTrashed()->get()->each(function (Content $content) {
            $this->assertEquals($this->testModel->getMorphClass(), $content->model_type);
            $this->assertEquals($this->testModel->getKey(), $content->model_id);
            $this->assertNotNull($content->deleted_at);
        });

        $this->assertDatabaseMissing('dummies');
    }
}
