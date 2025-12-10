<?php

namespace Miladev\LaravelMeta\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Miladev\LaravelMeta\Tests\Models\Post;
use Miladev\LaravelMeta\Tests\TestCase;

class MetaModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_saving_and_getting_meta_with_model()
    {
        $post = new Post();
        $post->save();

        $meta = $post->saveMeta('fake_key', 'fake value');

        $this->assertEquals('fake_key', $meta->key);

        $meta_value = $post->getMeta('fake_key');

        $this->assertEquals('fake value', $meta_value);
    }

    /** @test */
    public function test_find_meta_with_value()
    {
        $post = new Post();
        $post->save();

        $post->saveMeta('fake_key', 'fake value');

        $post->saveMeta('mili', 'my value');

        $post->saveMeta('mili2', 'my');

        $meta_value = $post->findMeta('my');

        $this->assertTrue($meta_value->pluck('key')->contains('mili'));
        $this->assertTrue($meta_value->pluck('key')->contains('mili2'));
    }

    /** @test */
    public function test_updating_meta_with_model()
    {
        $post = new Post();
        $post->save();

        $post->saveMeta('fake_key', 'fake value');
        $post->updateMeta('fake_key', 'real value');
        $meta_value = $post->getMeta('fake_key');

        $this->assertEquals('real value', $meta_value);
    }

    /** @test */
    public function test_deleting_meta_with_model()
    {
        $post = new Post();
        $post->save();

        $post->saveMeta('fake_key', 'fake value');
        $meta_value = $post->getMeta('fake_key');

        $this->assertEquals('fake value', $meta_value);

        $post->deleteMeta('fake_key');
        $meta_value = $post->getMeta('fake_key');

        // getMeta returns the default string when missing
        $this->assertEquals('', $meta_value);
    }
}
