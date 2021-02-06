<?php

namespace Karvaka\Wired\Table;

use Illuminate\Support\ServiceProvider;

class WiredTableServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->registerViews();
        $this->registerPublishing();
    }

    protected function registerViews(): void
    {
        $this->loadViewsFrom(
            __DIR__ . '/../resources/views', 'wired-table'
        );
    }

    protected function registerPublishing(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/wired-table'),
        ], 'wired-table-views');
    }
}
