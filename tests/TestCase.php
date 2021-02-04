<?php

namespace Tests;

use Karvaka\Wired\Table\WiredTableServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            WiredTableServiceProvider::class
        ];
    }
}
