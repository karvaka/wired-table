<?php

namespace Karvaka\Wired\Table\Filters;

use Illuminate\Database\Eloquent\Builder;

class SelectFilter extends Filter
{
    use Concerns\HasOptions;

    public string $component = 'wired-table-select-filter';

    public function apply(Builder $query, $value): void
    {
        $query->where($this->attribute, '=' , $value);
    }
}
