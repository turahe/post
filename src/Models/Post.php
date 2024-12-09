<?php

declare(strict_types=1);
/*
 * This source code is the proprietary and confidential information of
 * Nur Wachid. You may not disclose, copy, distribute,
 *  or use this code without the express written permission of
 * Nur Wachid.
 *
 * Copyright (c) 2023.
 *
 *
 */

namespace Turahe\Post\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Turahe\Core\Concerns\HasTags;
use Turahe\UserStamps\Concerns\HasUserStamps;

class Post extends Model
{
    use HasSlug;
    use HasTags;
    use HasUlids;
    use HasUserStamps;
    use SoftDeletes;

    /**
     * @var string
     */
    public $dateFormat = 'U';

    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'type',
        'is_sticky',
        'published_at',
        'language',
        'layout',
    ];

    protected function casts()
    {
        return [
            'published_at' => 'datetime',
            'is_sticky' => 'boolean',
        ];

    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now());
    }

    public function scopeNotPublished(Builder $query): Builder
    {
        return $query->where(function (Builder $query): Builder {
            return $query->whereNull('published_at')
                ->orWhere('published_at', '>', now());
        });
    }
}
