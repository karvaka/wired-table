<?php

namespace Karvaka\Wired\Table\Tabs;

use Karvaka\Wired\Table\Utils;

class Tab
{
    public string $attribute;
    public string $label;
    public $filterUsing;

    public function __construct(string $attribute, ?string $label = null)
    {
        $this->attribute = $attribute;
        $this->label = $label ?: Utils::humanize($attribute);
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
}
