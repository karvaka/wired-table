<?php

namespace Karvaka\Wired\Table\Filters;

use Illuminate\Database\Eloquent\Builder;

class DateFilter extends Filter
{
    public string $component = 'date';

    public function apply(Builder $query, $value): void
    {
        // TODO
    }
}
