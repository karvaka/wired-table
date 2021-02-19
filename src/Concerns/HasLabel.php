<?php

namespace Karvaka\Wired\Table\Concerns;

trait HasLabel
{
    protected string $label;

    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }
}
