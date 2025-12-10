<?php

namespace Miladev\LaravelMeta\Tests\Unit;

use Miladev\LaravelMeta\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    /** @test */
    public function package_config_is_available()
    {
        $this->assertNotNull(config('meta'));
        $this->assertArrayHasKey('table_name', config('meta'));
    }
}
