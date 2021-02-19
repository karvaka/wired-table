<?php

namespace Karvaka\Wired\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Karvaka\Wired\Table\Columns\Column;

trait WithSearch
{
    public bool $enableSearch = true;
    public string $search = '';
    public int $searchDebounce = 300;

    public function initializeWithSearch(): void
    {
        if ($this->enableSearch) {
            $this->queryString = array_merge($this->queryString, ['search' => ['except' => '']]);
        }
    }

    public function searchCriteria(): string
    {
        return trim($this->search);
    }

    public function resetSearch(): void
    {
        $this->search = '';
    }

    public function updatedSearch(): void
    {
        $this->emitSelf('searchChanged');
    }

    public function applySearch(Builder $query): void
    {
        if (! $this->enableSearch || ! $this->searchCriteria()) {
            return;
        }

        $query->where(function (Builder $query) {
            $this->getColumns()
                ->filter(fn (Column $column) => $column->isSearchable())
                ->each(function (Column $column) use ($query) {
                    if (is_callable($callback = $column->getSearchCallback())) {
                        $this->applySearchCallback($query, $column, $callback);
                    } else if(Str::contains($column->getAttribute(), '.')) {
                        $this->applySearchByRelation($query, $column);
                    } else {
                        $query->orWhere($column->getAttribute(), 'like', '%' . $this->searchCriteria() . '%');
                    }
                });
        });
    }

    private function applySearchCallback(Builder $query, Column $column, callable $callback): void
    {
        $query->orWhere(function (Builder $query) use ($column, $callback) {
            app()->call($callback, ['query' => $query, 'criteria' => $this->searchCriteria()]);
        });
    }

    private function applySearchByRelation(Builder $query, Column $column): void
    {
        $segments = explode('.', $column->getAttribute());
        $attribute = array_pop($segments);
        $relation = implode('.', $segments);

        $query->orWhereHas($relation, function (Builder $query) use ($attribute) {
            $query->where($attribute, 'like', '%' . $this->searchCriteria() . '%');
        });
    }
}
