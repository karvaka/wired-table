<?php

namespace Karvaka\Wired\Table\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Karvaka\Wired\Table\Column;

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
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    public function applySearch(Builder $query): void
    {
        if (! $this->searchCriteria()) {
            return;
        }

        $query->where(function (Builder $query) {
            $this->getColumns()
                ->where('searchable', '=', true)
                ->each(function (Column $column) use ($query) {
                    if (is_callable($column->searchUsing)) {
                        $query->orWhere(function (Builder $query) use ($column) {
                            app()->call($column->searchUsing, ['query' => $query, 'criteria' => $this->searchCriteria()]);
                        });
                    } else if(Str::contains($column->attribute, '*')) {
                        // TODO search by relationships
                    } else {
                        $query->orWhere($column->attribute, 'like', '%' . $this->searchCriteria() . '%');
                    }
                });
        });
    }
}
