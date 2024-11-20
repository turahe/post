<?php

namespace Turahe\Post\Tests\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;

class User extends \Illuminate\Foundation\Auth\User
{
    use HasUlids;
}
