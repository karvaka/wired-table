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

//    public function visibleIf(callable $callback): self
//    {
//        $this->visible = value($callback);
//
//        return $this;
//    }

    public function hidden(): self
    {
        $this->visible = false;

        return $this;
    }
}
