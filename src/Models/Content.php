<?php

declare(strict_types=1);

namespace Turahe\Post\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Turahe\UserStamps\Concerns\HasUserStamps;

/**
 * @property string $id
 * @property string $model_type
 * @property string $model_id
 * @property string $content_raw
 * @property string $content_html
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $author
 * @property-read \App\Models\User|null $destroyer
 * @property-read \App\Models\User|null $editor
 * @property-read mixed $read_time
 * @property-read mixed $word_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content whereContentHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content whereContentRaw($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Content withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Content extends Model
{
    use HasUlids;
    use HasUserStamps;
    use SoftDeletes;

    /**
     * @var string
     */
    public $dateFormat = 'U';

    /**
     * @var string[]
     */
    protected $fillable = [
        'content_raw',
        'content_html',
    ];

    protected function wordCount(): Attribute
    {
        $count = 0;
        if ($this->content_raw) {
            $count = str_word_count($this->attributes['content_raw']);
        }

        return Attribute::get(fn () => $count);
    }

    protected function readTime(): Attribute
    {
        $minutesToRead = round($this->word_count / 230); // getting the number of minutes

        if ($minutesToRead < 1) {// if the time is less than a minute
            $minutes = 'less than a minute';
        } else {
            $minutes = $minutesToRead; // saving the time in the variable
        }

        return Attribute::get(function () use ($minutes, $minutesToRead) {
            return [
                'text' => $minutes,
                'minutes' => $minutesToRead,
                'time' => round(($this->word_count / 230) * 60),
                'words' => $this->word_count,
            ];
        });
    }
}
