<?php

namespace Karvaka\Wired\Table\Filters\Concerns;

trait HasOptions
{
    private array $options = [];

    public function options(array $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
