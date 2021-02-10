<?php

namespace Karvaka\Wired\Table\Filters;

use Illuminate\Database\Eloquent\Builder;

class SelectFilter extends Filter
{
    use Concerns\HasOptions;

    public string $component = 'wired-table.filters.select';

    public function apply(Builder $query, $value): void
    {
        $query->where($this->attribute, '=' , $value);
    }
}
