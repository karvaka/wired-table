<?php

namespace Karvaka\Wired\Table\Filters;

use Illuminate\Database\Eloquent\Builder;

class BooleanFilter extends Filter
{
    use Concerns\HasOptions;

    public string $defaultComponent = 'wired-table-boolean-filter';

    public function apply(Builder $query, $value): void
    {
        $query->whereIn($this->attribute, (array)$value);
    }
}
