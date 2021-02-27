<?php

namespace Karvaka\Wired\Table\Concerns;

trait HasAttribute
{
    protected string $attribute;

    public function attribute(string $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }

    public function getAttribute(): string
    {
        return $this->attribute;
    }
}
