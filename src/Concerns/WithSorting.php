<?php

namespace Karvaka\Wired\Table\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait WithSorting
{
    public bool $enableSorting = true;
    public ?string $sort = null;
    public ?string $defaultSort = null;

    public function initializeWithSorting(): void
    {
        if ($this->enableSorting) {
            $this->sort = $this->sort ?: $this->defaultSort;

            $this->queryString = array_merge($this->queryString, ['sort' => ['except' => $this->defaultSort]]);
        }
    }

    public function sortBy(string $attribute): void
    {
        if ($attribute === $this->sortAttribute() && $this->sortDirection() === 'asc') {
            $this->sort = '-' . $attribute;
        } else {
            $this->sort = $attribute;
        }
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

        if ($this->getColumns()->where('attribute', '=', $this->sortAttribute())->isEmpty()) {
            return;
        }

        // TODO call custom handler

        $query->orderBy($this->sortAttribute(), $this->sortDirection());
    }
}
