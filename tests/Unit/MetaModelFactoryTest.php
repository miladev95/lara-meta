<?php

namespace Miladev\LaravelMeta\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Miladev\LaravelMeta\Models\Meta;
use Miladev\LaravelMeta\Tests\Models\Post;
use Miladev\LaravelMeta\Tests\TestCase;

class MetaModelFactoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function factory_creates_meta_with_key_and_value()
    {
        $post = new Post();
        $post->save();

        $meta = Meta::factory()->create([
            'metable_type' => get_class($post),
            'metable_id' => $post->id,
        ]);

        $this->assertNotEmpty($meta->key);
        $this->assertNotEmpty($meta->value);
    }

    /** @test */
    public function get_table_uses_config_or_default()
    {
        config(['meta.table_name' => 'custom_metas']);

        $meta = new Meta();

        $this->assertEquals('custom_metas', $meta->getTable());

        config(['meta.table_name' => null]);

        $meta2 = new Meta();

        $this->assertEquals('laravel_metas', $meta2->getTable());
    }
}
