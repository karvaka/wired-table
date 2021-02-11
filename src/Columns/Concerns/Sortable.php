<?php

namespace Karvaka\Wired\Table\Columns\Concerns;

trait Sortable
{
    public bool $sortable = false;
    public $sortUsing;

    public function sortable(): self
    {
        $this->sortable = true;

        return $this;
    }

    public function sortUsing(callable $callable): self
    {
        $this->sortable = true;
        $this->sortUsing = $callable;

        return $this;
    }
}
