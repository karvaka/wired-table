<?php

namespace Karvaka\Wired\Table\Tabs;

use Karvaka\Wired\Table\Utils;
use Karvaka\Wired\Table\Concerns\{HasAttribute, HasLabel, HasVisibility};

class Tab
{
    use HasAttribute,
        HasLabel,
        HasVisibility;

    protected $filterUsing;

    public function __construct(string $attribute, ?string $label = null)
    {
        $this->attribute = $attribute;
        $this->label = $label ?? Utils::translate($attribute) ?? Utils::humanize($attribute);
    }

    public static function make(string $attribute, ?string $label = null): self
    {
        return new static($attribute, $label);
    }

    public function filterUsing(callable $callable): self
    {
        $this->filterUsing = $callable;
        return $this;
    }

    public function getFilterCallback(): ?callable
    {
        return $this->filterUsing;
    }
}
