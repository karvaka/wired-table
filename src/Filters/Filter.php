<?php

namespace Karvaka\Wired\Table\Filters;

use Illuminate\Database\Eloquent\Builder;
use Karvaka\Wired\Table\Utils;
use Karvaka\Wired\Table\Concerns\{HasComponent, HasAttribute, HasLabel, HasVisibility};

abstract class Filter
{
    use HasComponent,
        HasAttribute,
        HasLabel,
        HasVisibility;

    public function __construct($attribute, $label = null)
    {
        $this->attribute = $attribute;
        $this->label = $label ?? Utils::translate($attribute) ?? Utils::humanize($attribute);
    }

    public static function make($attribute, $label = null): self
    {
        return new static($attribute, $label);
    }

    public abstract function apply(Builder $query, $value): void;
}
