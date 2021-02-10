<?php

namespace Karvaka\Wired\Table\Filters\Concerns;

trait HasOptions
{
    public array $options = [];

    public function options(array $options): self
    {
        $this->options = $options;

        return $this;
    }
}
