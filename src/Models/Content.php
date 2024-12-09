<?php

declare(strict_types=1);

namespace Turahe\Post\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Turahe\UserStamps\Concerns\HasUserStamps;

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
        'model_id',
        'model_type',
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
