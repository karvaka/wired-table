<?php

namespace Karvaka\Wired\Table;

use Closure;
use BadMethodCallException;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination,
        Concerns\WithSearch;

    public bool $enablePagination = true;
    // public array $perPageOptions = [10, 25, 50];
    public int $perPage = 25;

    private static ?Closure $resolveDiscoverableNamespaceUsing = null;

    public function query(): Builder
    {
        $discoveredModel = $this->resolveDiscoverableNamespace(get_class($this));

        if (class_exists($discoveredModel) && method_exists($discoveredModel, 'query')) {
            return $discoveredModel::query();
        }

        throw new BadMethodCallException('Method [[static::query()]] must return [[\Illuminate\Database\Eloquent\Builder]] instance.');
    }

    public function columns(): array
    {
        return [];
    }

    final private function getModels()
    {
        $query = $this->query();

        $this->applySearch($query);

        return $this->enablePagination ?
            $query->paginate($this->perPage) :
            $query->get();
    }

    final private function getColumns(): Collection
    {
        return collect($this->columns());
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
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

    public function render()
    {
        return view('wired-table::table')->with([
            'models' => $this->getModels(),
            'columns' => $this->getColumns()
        ]);
    }
}
