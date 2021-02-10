<?php

namespace Karvaka\Wired\Table\Filters;

use Illuminate\Database\Eloquent\Builder;
use Karvaka\Wired\Table\Utils;

abstract class Filter
{
    public string $attribute;
    public string $label;
    public string $component;

    public function __construct($attribute, $label = null)
    {
        $this->attribute = $attribute;
        $this->label = $label ?: Utils::humanize($attribute);
    }

    public static function make($attribute, $label = null): self
    {
        return new static($attribute, $label);
    }

    public abstract function apply(Builder $query, $value): void;
}
