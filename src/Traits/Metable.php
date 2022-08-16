<?php

namespace Miladev\LaravelMeta\Traits;

use Illuminate\Support\Facades\DB;
use Miladev\LaravelMeta\Models\Meta;

trait Metable
{
    public function getMeta(string $key, string $default = ''): string
    {
        $meta = $this->metas()->where('key', $key)->first();

        return $meta ? $meta->value : $default;
    }

    public function findMeta(string $value)
    {
        $meta = $this->metas()->where('value' , 'LIKE', '%' . $value . '%')->get();

        return $meta;
    }

    public function saveMeta(string $key, string $value)
    {
        return $this->updateMeta($key, $value);
    }

    public function updateMeta(string $key, string $value)
    {
        return $this->metas()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    public function deleteMeta(string $key): int
    {
        return $this->metas()
            ->where('key', $key)
            ->delete();
    }

    public function metas()
    {
        return $this->morphMany(Meta::class, 'metable');
    }

    public function scopeWithMetas($query)
    {
        return $query->with('metas');
    }

    public function getMetaTableName(): string
    {
        return config('meta.table_name') ?? 'laravel_metas';
    }

    public function getMetaTable(): \Illuminate\Database\Query\Builder
    {
        return DB::table($this->getMetaTableName());
    }
}
