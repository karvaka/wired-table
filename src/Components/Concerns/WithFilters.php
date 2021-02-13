<?php

namespace Karvaka\Wired\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Karvaka\Wired\Table\Filters\Filter;

trait WithFilters
{
    public bool $enableFilters = true;
    public array $filter = [];

    // TODO what if there is some rules in class?
    public array $rules = [
        'filter' => ['array'],
        'filter.*' => ['string']
    ];

    public function initializeWithFilters(): void
    {
        if ($this->enableFilters) {
            $this->queryString = array_merge($this->queryString, ['filter' => ['except' => []]]);
        }
    }

    public function filters(): array
    {
        return [];
    }

    public function resetFilters(): void
    {
        $this->filter = [];
    }

    public function resetFilter($attribute): void
    {
        unset($this->filter[$attribute]);
    }

    public function getFilters(): Collection
    {
        return collect($this->filters());
    }

    public function applyFilters(Builder $query): void
    {
        if (! $this->enableFilters) {
            return;
        }

        $query->where(function (Builder $query) {
            $this->getFilters()->each(function (Filter $filter) use ($query) {
                if (! $value = $this->filter[$filter->attribute] ?? null) {
                    return;
                }

                $filter->apply($query, $value);
            });
        });
    }
}
