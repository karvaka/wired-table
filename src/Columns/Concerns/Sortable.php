<?php

namespace Karvaka\Wired\Table\Columns\Concerns;

trait Sortable
{
    public bool $sortable = false;

    public function sortable(): self
    {
        $this->sortable = true;

        return $this;
    }
}
