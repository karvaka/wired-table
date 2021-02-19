<?php

namespace Karvaka\Wired\Table\Concerns;

trait HasVisibility
{
    protected bool $visible = true;

    public function visible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function hidden(): self
    {
        $this->visible = false;

        return $this;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }
}
