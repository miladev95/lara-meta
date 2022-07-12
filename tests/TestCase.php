<?php

namespace Miladev\LaravelMeta\Tests;

use Miladev\LaravelMeta\MetaServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            function (string $modelName) {
                return 'Miladev\\LaravelMeta\\Database\\Factories\\' . class_basename($modelName) . 'Factory';
            }
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            MetaServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        //config()->set('database.default', 'testing');

        //$migration = include __DIR__.'/../database/migrations/create_metas_table.php';
        //$migration->up();
    }
}
