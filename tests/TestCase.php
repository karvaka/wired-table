<?php

namespace Tests;

use Illuminate\Contracts\Auth\Authenticatable;
use Karvaka\Wired\Table\Components\Table;
use Karvaka\Wired\Table\WiredTableServiceProvider;
use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Livewire\LivewireServiceProvider;
use Laravel\Jetstream\JetstreamServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Mockery;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected ?Authenticatable $authenticatedAs;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
        $this->setUpDiscoverableModelCallback();
    }

    protected function setUpDatabase(): void
    {
        $this->loadMigrationsFrom(
            __DIR__ . '/migrations'
        );

        Factory::useNamespace('');

        $this->artisan('migrate', ['--database' => 'wired_testing'])->run();
    }

    protected function setUpDiscoverableModelCallback(): void
    {
        Table::resolveDiscoverableModelUsing(function (string $class) {
            return 'Tests\\Fixtures\\Models\\' . Table::guessModelClassForComponent($class);
        });
    }

    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            JetstreamServiceProvider::class,
            BladeIconsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            WiredTableServiceProvider::class
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        $app['config']->set('app.key', 'base64:4QnAKQ9ykHOz4/+395vluqUNUsbYvl5hLEb4RSGTu88=');
        $app['config']->set('database.default', 'wired_testing');
        $app['config']->set('database.connections.wired_testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $app['config']->set('auth.providers.users.model', User::class);
    }

    protected function authenticate(): self
    {
        $this->actingAs($this->authenticatedAs = Mockery::mock(Authenticatable::class));

        $this->authenticatedAs->shouldReceive('getAuthIdentifier')->andReturn(1);
        $this->authenticatedAs->shouldReceive('getKey')->andReturn(1);

        return $this;
    }
}
