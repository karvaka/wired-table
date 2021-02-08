<?php

namespace Karvaka\Wired\Table\Filters;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    public string $attribute;
    public string $label;

    public function __construct($attribute, $label = null)
    {
        $this->attribute = $attribute;
        $this->label = $label ?? Str::title(Str::camel($attribute));
    }

    public static function make($attribute, $label = null)
    {
        return new static($attribute, $label);
    }

    public abstract function apply(Builder $query, $value): void;
}
