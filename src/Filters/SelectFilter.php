<?php

namespace Karvaka\Wired\Table\Filters;

use Illuminate\Database\Eloquent\Builder;

class SelectFilter extends Filter
{
    public string $component = 'select';

    public array $options = [];

    public function apply(Builder $query, $value): void
    {
        // TODO
    }

    public function options(array $options)
    {
        $this->options = $options;

        return $this;
    }
}
