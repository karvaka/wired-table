<?php

namespace Tests;

use Karvaka\Wired\Table\Table;
use Karvaka\Wired\Table\WiredTableServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            WiredTableServiceProvider::class
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Table::resolveDiscoverableModelUsing(function (string $class) {
            return 'Tests\\Fixtures\\Models\\' . Table::predictModelClassForComponent($class);
        });
    }
}
