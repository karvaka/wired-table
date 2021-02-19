<?php

namespace Karvaka\Wired\Table\Columns\Concerns;

trait Searchable
{
    protected bool $searchable = false;
    protected $searchCallback = null;

    public function searchable(): self
    {
        $this->searchable = true;

        return $this;
    }

    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    public function searchUsing(callable $callable): self
    {
        $this->searchable = true;
        $this->searchCallback = $callable;

        return $this;
    }

    public function getSearchCallback(): ?callable
    {
        return $this->searchCallback;
    }
}
