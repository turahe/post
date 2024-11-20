<?php

namespace Turahe\Post\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Turahe\Post\Tests\Factories\PostFactory;

class Post extends \Turahe\Post\Models\Post
{

    use HasFactory;

    protected static function newFactory()
    {
        return PostFactory::new();
    }
}