<?php

namespace Karvaka\Wired\Table\Components\Concerns;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Karvaka\Wired\Table\Columns\Column;

trait WithSorting
{
    public bool $enableSorting = true;
    public ?string $sort = null;

    public function initializeWithSorting(): void
    {
        if ($this->enableSorting) {
            $default = $this->getDefaultSort();
            $this->sort = $this->sort ?: $default;

            $this->queryString = array_merge($this->queryString, ['sort' => ['except' => $default]]);
        }
    }

    protected function getDefaultSort()
    {
        if (method_exists($this, 'defaultSort')) return $this->defaultSort();
        if (property_exists($this, 'defaultSort')) return $this->defaultSort;

        return null;
    }

    public function sortBy(string $attribute): void
    {
        if ($attribute === $this->sortAttribute() && $this->sortDirection() === 'asc') {
            $this->sort = '-' . $attribute;
        } else {
            $this->sort = $attribute;
        }

        $this->emitSelf('sortChanged');
    }

    public function sortAttribute(): ?string
    {
        return ltrim($this->sort, '-');
    }

    public function sortDirection(): string
    {
        return Str::startsWith($this->sort, '-') ? 'desc' : 'asc';
    }

    public function applySorting(Builder $query): void
    {
        if (! $this->enableSorting || ! $this->sortAttribute()) {
            return;
        }

        if ($this->getColumns()->filter(fn (Column $column) => $column->getAttribute() === $this->sortAttribute())->isEmpty()) {
            return;
        }

        // TODO call custom handler

        // TODO sort by relation

        $query->orderBy($this->sortAttribute(), $this->sortDirection());
    }
}
