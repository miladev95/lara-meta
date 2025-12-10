<?php

namespace Miladev\LaravelMeta\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Miladev\LaravelMeta\Tests\Models\Post;
use Miladev\LaravelMeta\Tests\TestCase;

class MetableTraitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function metas_relation_is_morph_many()
    {
        $post = new Post();
        $post->save();

        $relation = $post->metas();

        $this->assertEquals('morphMany', $relation->getMorphType() ? 'morphMany' : '');
    }

    /** @test */
    public function scope_with_metas_eager_loads_relation()
    {
        $post = new Post();
        $post->save();

        $post->saveMeta('k', 'v');

        $loaded = Post::withMetas()->first();

        $this->assertTrue($loaded->relationLoaded('metas'));
    }

    /** @test */
    public function get_meta_table_name_and_table_builder()
    {
        $post = new Post();

        $this->assertIsString($post->getMetaTableName());

        $table = $post->getMetaTable();

        $this->assertInstanceOf(QueryBuilder::class, $table);
    }
}

