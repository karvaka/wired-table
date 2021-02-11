<?php

namespace Karvaka\Wired\Table;

use Closure;
use BadMethodCallException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination,
        Concerns\WithActions,
        Concerns\WithColumns,
        Concerns\WithFilters,
        Concerns\WithPerPage,
        Concerns\WithSearch,
        Concerns\WithSorting,
        Concerns\WithTabs;

    public bool $enablePagination = true;

    private static ?Closure $resolveDiscoverableNamespaceUsing = null;

    public function query(): Builder
    {
        $discoveredModel = $this->resolveDiscoverableNamespace(get_class($this));

        if (class_exists($discoveredModel) && method_exists($discoveredModel, 'query')) {
            return $discoveredModel::query();
        }

        throw new BadMethodCallException('Method [[static::query()]] must return [[\Illuminate\Database\Eloquent\Builder]] instance.');
    }

    final private function getModels()
    {
        $query = $this->query();

        // TODO if pagination enabled, page > 1 and there is no results force goto last page

        // TODO automatically collect concerns handlers
        $this->applySearch($query);
        $this->applyFilters($query);
        $this->applySorting($query);
        $this->applyTabs($query);

        return $this->enablePagination ?
            $query->paginate($this->enablePerPage ? $this->perPage : null) :
            $query->get();
    }

    private function findModel($id): ?Model
    {
        return $this->getModels()->find($id);
    }

    protected function resolveDiscoverableNamespace(string $class): string
    {
        $resolver = static::$resolveDiscoverableNamespaceUsing ?: function (string $class) {
            return app()->getNamespace() . 'Models\\' . static::guessModelClassForComponent($class);
        };

        return app()->call($resolver, ['class' => $class]);
    }

    public static function resolveDiscoverableModelUsing(Closure $callback): void
    {
        static::$resolveDiscoverableNamespaceUsing = $callback;
    }

    public static function guessModelClassForComponent(string $class): string
    {
        return Str::of($class)->classBasename()->replaceLast('Table', '')->singular();
    }

    public function render()
    {
        return view('wired-table::table')->with([
            'models' => $this->getModels(),
            'columns' => $this->getColumns(),
            'actions' => $this->getActions(),
            'filters' => $this->getFilters(),
            'tabs' => $this->getTabs(),
        ]);
    }
}
