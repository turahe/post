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
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Turahe\Core\Concerns\HasTags;
use Turahe\Post\Concerns\HasContents;
use Turahe\Post\Databases\Factories\PostFactory;
use Turahe\UserStamps\Concerns\HasUserStamps;

/**
 * @property string $id
 * @property string $slug
 * @property string $title
 * @property string|null $subtitle subtitle of title post
 * @property string|null $description description of post
 * @property string $type
 * @property bool $is_sticky
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property string $language
 * @property string|null $layout
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $author
 * @property-read \App\Models\User|null $destroyer
 * @property-read \App\Models\User|null $editor
 * @property \Illuminate\Database\Eloquent\Collection<int, \Turahe\Core\Models\Tag> $tags
 * @property-read int|null $tags_count
 *
 * @method static Builder<static>|Post isPublished()
 * @method static Builder<static>|Post newModelQuery()
 * @method static Builder<static>|Post newQuery()
 * @method static Builder<static>|Post onlyTrashed()
 * @method static Builder<static>|Post query()
 * @method static Builder<static>|Post whereCreatedAt($value)
 * @method static Builder<static>|Post whereCreatedBy($value)
 * @method static Builder<static>|Post whereDeletedAt($value)
 * @method static Builder<static>|Post whereDeletedBy($value)
 * @method static Builder<static>|Post whereDescription($value)
 * @method static Builder<static>|Post whereId($value)
 * @method static Builder<static>|Post whereIsSticky($value)
 * @method static Builder<static>|Post whereLanguage($value)
 * @method static Builder<static>|Post whereLayout($value)
 * @method static Builder<static>|Post wherePublishedAt($value)
 * @method static Builder<static>|Post whereSlug($value)
 * @method static Builder<static>|Post whereSubtitle($value)
 * @method static Builder<static>|Post whereTitle($value)
 * @method static Builder<static>|Post whereType($value)
 * @method static Builder<static>|Post whereUpdatedAt($value)
 * @method static Builder<static>|Post whereUpdatedBy($value)
 * @method static Builder<static>|Post withAllTags(\ArrayAccess|\Turahe\Core\Models\Tag|array|string $tags, ?string $type = null)
 * @method static Builder<static>|Post withAllTagsOfAnyType($tags)
 * @method static Builder<static>|Post withAnyTags(\ArrayAccess|\Turahe\Core\Models\Tag|array|string $tags, ?string $type = null)
 * @method static Builder<static>|Post withAnyTagsOfAnyType($tags)
 * @method static Builder<static>|Post withTrashed()
 * @method static Builder<static>|Post withoutTags(\ArrayAccess|\Turahe\Core\Models\Tag|array|string $tags, ?string $type = null)
 * @method static Builder<static>|Post withoutTrashed()
 * @method static Builder<static>|Post notPublished()
 * @method static Builder<static>|Post published()
 *
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;
    use HasSlug;
    use HasTags;
    use HasUlids;
    use HasUserStamps;

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

    protected static function newFactory()
    {
        return PostFactory::new();
    }
}
