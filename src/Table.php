<?php

namespace Karvaka\Wired\Table;

use Closure;
use BadMethodCallException;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

abstract class Table extends Component
{
    private static ?Closure $resolveDiscoverableNamespaceUsing = null;

    public function query(): Builder
    {
        $discoveredModel = $this->resolveDiscoverableNamespace(get_class($this));

        if (class_exists($discoveredModel) && method_exists($discoveredModel, 'query')) {
            return $discoveredModel::query();
        }

        throw new BadMethodCallException('Method [[static::query()]] must return [[\Illuminate\Database\Eloquent\Builder]] instance.');
    }

    protected function resolveDiscoverableNamespace(string $class): string
    {
        if (! is_null(static::$resolveDiscoverableNamespaceUsing)) {
            return call_user_func_array(static::$resolveDiscoverableNamespaceUsing, [$class]);
        }

        return app()->getNamespace() . 'Models\\' . static::predictModelClassForComponent($class);
    }

    public static function resolveDiscoverableModelUsing(Closure $callback): void
    {
        static::$resolveDiscoverableNamespaceUsing = $callback;
    }

    public static function predictModelClassForComponent(string $class): string
    {
        return Str::of($class)
            ->classBasename()
            ->replaceLast('Table', '')
            ->singular();
    }
}
