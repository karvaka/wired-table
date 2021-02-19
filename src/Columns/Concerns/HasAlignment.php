<?php

namespace Karvaka\Wired\Table\Columns\Concerns;

trait HasAlignment
{
    protected string $alignment = 'left';

    public function align(string $alignment): self
    {
        $this->alignment = $alignment;

        return $this;
    }

    public function alignLeft(): self
    {
        $this->alignment = 'left';

        return $this;
    }

    public function alignRight(): self
    {
        $this->alignment = 'right';

        return $this;
    }

    public function alignCenter(): self
    {
        $this->alignment = 'center';

        return $this;
    }

    public function getAlignment(): string
    {
        return $this->alignment;
    }
}
