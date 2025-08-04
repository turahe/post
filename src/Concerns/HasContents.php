<?php

declare(strict_types=1);

namespace Turahe\Post\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Turahe\Post\Models\Content;

trait HasContents
{
    /**
     * Boot the HasContents trait
     */
    protected static function bootHasContents(): void
    {
        static::deleting(function ($model): void {
            $model->contents()->delete();
        });
    }

    public function contents(): MorphMany
    {
        return $this->morphMany(Content::class, 'model')
            ->orderByDesc('created_at');
    }

    public function getContent()
    {
        return $this->contents()->first();
    }

    protected function contentHtml(): Attribute
    {
        return Attribute::get(fn () => $this->getContent()?->content_html);
    }

    protected function contentRaw(): Attribute
    {
        return Attribute::get(fn () => $this->getContent()?->content_raw);
    }

    protected function content(): Attribute
    {
        return $this->contentHtml();
    }

    /**
     * Create Content
     *
     * @throws \League\CommonMark\Exception\CommonMarkException
     */
    public function setContents($content): Content
    {
        $markdown = new GithubFlavoredMarkdownConverter();

        return $this->contents()->create([
            'content_raw' => $content,
            'content_html' => $markdown->convert($content),
        ]);
    }
}
