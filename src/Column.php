<?php

namespace Karvaka\Wired\Table;

class Column
{
    public string $attribute;
    public string $component = 'data';
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

    public function component(string $component): self
    {
        $this->component = $component;

        return $this;
    }

    public function asRaw(): self
    {
        return $this->component('raw');
    }

    public function asEmail(): self
    {
        return $this->component('email');
    }

    public function asPhone(): self
    {
        return $this->component('phone');
    }

    public function asImage(): self
    {
        return $this->component('image');
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
