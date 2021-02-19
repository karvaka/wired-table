<?php

namespace Karvaka\Wired\Table\Filters;

use Illuminate\Database\Eloquent\Builder;

class DateFilter extends Filter
{
    protected string $defaultComponent = 'wired-table-date-filter';

    public function apply(Builder $query, $value): void
    {
        $query->whereDate($this->attribute, '=' , $value);
    }
}
