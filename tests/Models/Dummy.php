<?php

namespace Turahe\Post\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Turahe\Post\Concerns\HasContents;

class Dummy extends Model
{
    use HasContents;

}