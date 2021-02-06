<?php

namespace Karvaka\Wired\Table;

class Column
{
    public string $attribute;
    public bool $searchable = false;
    public $searchUsing = null;

    public function __construct(string $attribute)
    {
        $this->attribute = $attribute;
    }

    public static function make(string $attribute): self
    {
        return new static($attribute);
    }

    public function searchable(): self
    {
        $this->searchable = true;

        return $this;
    }

    public function searchUsing(callable $callable): self
    {
        $this->searchable = true;
        $this->searchUsing = $callable;

        return $this;
    }
}
