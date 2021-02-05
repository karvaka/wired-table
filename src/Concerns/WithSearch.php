<?php

namespace Karvaka\Wired\Table\Concerns;

use Illuminate\Database\Eloquent\Builder;
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
        if (! $this->search) {
            return;
        }

        $this->getColumns()
            ->where('searchable', '=', true)
            ->each(function (Column $column) use ($query) {
                $query->orWhere($column->attribute, 'like', '%' . $this->search . '%');

                // TODO search by relationships
            });
    }
}
