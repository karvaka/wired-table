<?php

namespace Karvaka\Wired\Table;

use Karvaka\Wired\Table\Console\{
    MakeActionCommand,
    MakeTableCommand
};
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
        $this->registerTranslations();
        $this->registerComponents();
        $this->registerCommands();
        $this->registerPublishing();
    }

    protected function registerViews(): void
    {
        $this->loadViewsFrom(
            __DIR__ . '/../resources/views', 'wired-table'
        );
    }

    protected function registerTranslations(): void
    {
        $this->loadJsonTranslationsFrom(
            __DIR__ . '/../resources/lang'
        );
    }

    protected function registerComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('boolean-filter');
            $this->registerComponent('date-filter');
            $this->registerComponent('select-filter');
        });
    }

    protected function registerComponent(string $component)
    {
        Blade::component('wired-table::components.'.$component, 'wired-table-'.$component);
    }

    protected function registerCommands(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            MakeActionCommand::class,
            MakeTableCommand::class
        ]);
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
