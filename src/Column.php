<?php

namespace Karvaka\Wired\Table;

class Column
{
    public string $attribute;

    public function __construct(string $attribute)
    {
        $this->attribute = $attribute;
    }

    public static function make(string $attribute): Column
    {
        return new static($attribute);
    }
}
