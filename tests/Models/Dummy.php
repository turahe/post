<?php

namespace Turahe\Post\Tests\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Turahe\Post\Concerns\HasContents;

class Dummy extends Model
{
    use HasContents;
    use HasUlids;

    public $timestamps = false;

    protected $guarded = [];
}
