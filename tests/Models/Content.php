<?php

namespace Turahe\Post\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Turahe\Post\Tests\Factories\ContentFactory;
use Turahe\Post\Tests\Factories\PostFactory;

class Content extends \Turahe\Post\Models\Content
{
    use HasFactory;

    protected static function newFactory()
    {
        return ContentFactory::new();
    }

}