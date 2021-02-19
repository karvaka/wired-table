<?php

namespace Karvaka\Wired\Table\Columns\Concerns;

trait Sortable
{
    protected bool $sortable = false;
    protected $sortCallback;

    public function sortable(): self
    {
        $this->sortable = true;

        return $this;
    }

    public function isSortable(): bool
    {
        return $this->sortable;
    }

    public function sortUsing(callable $callable): self
    {
        $this->sortable = true;
        $this->sortCallback = $callable;

        return $this;
    }

    public function getSortCallback(): ?callable
    {
        return $this->sortCallback;
    }
}
