<?php

namespace Karvaka\Wired\Table\Columns\Concerns;

trait Searchable
{
    public bool $searchable = false;
    public $searchUsing = null;

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
