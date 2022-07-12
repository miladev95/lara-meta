<?php

namespace Miladev\LaravelMeta\Tests\Models;

use Miladev\LaravelMeta\Traits\Metable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Metable;
}
