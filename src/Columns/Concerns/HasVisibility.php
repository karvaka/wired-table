<?php

namespace Karvaka\Wired\Table\Columns\Concerns;

trait HasVisibility
{
    public bool $visible = true;

    public function visible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }
}
