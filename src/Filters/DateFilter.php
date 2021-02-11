<?php

namespace Karvaka\Wired\Table\Filters;

use Illuminate\Database\Eloquent\Builder;

class DateFilter extends Filter
{
    public string $component = 'wired-table-date-filter';

    public function apply(Builder $query, $value): void
    {
        $query->whereDate($this->attribute, '=' , $value);
    }
}
