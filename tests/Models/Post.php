<?php

namespace Miladev\LaravelMeta\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Miladev\LaravelMeta\Traits\Metable;

class Post extends Model
{
    use Metable;
}
