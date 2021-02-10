<?php

namespace Karvaka\Wired\Table;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class WiredTableServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->registerViews();
        $this->registerComponents();
        $this->registerPublishing();
    }

    protected function registerViews(): void
    {
        $this->loadViewsFrom(
            __DIR__ . '/../resources/views', 'wired-table'
        );
    }

    protected function registerComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('filters.boolean');
            $this->registerComponent('filters.date');
            $this->registerComponent('filters.select');
        });
    }

    protected function registerComponent(string $component)
    {
        Blade::component('wired-table::components.'.$component, 'wired-table.'.$component);
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
