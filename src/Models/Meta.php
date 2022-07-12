<?php

namespace Miladev\LaravelMeta\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    public $timestamps = false;

    /**
     * @return string
     */
    public function getTable(): string
    {
        return config('meta.table_name') ?? 'laravel_metas';
    }
}
