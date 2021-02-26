<?php

namespace Karvaka\Wired\Table\Filters\Concerns;

trait HasOptions
{
    private iterable $options = [];

    public function options(iterable $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): iterable
    {
        return $this->options;
    }
}
