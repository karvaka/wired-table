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
    }

    protected function registerViews(): void
    {
        $this->loadViewsFrom(
            __DIR__ . '/../resources/views', 'wired-table'
        );
    }
}
