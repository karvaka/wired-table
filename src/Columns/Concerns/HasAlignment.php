<?php

namespace Karvaka\Wired\Table\Columns\Concerns;

trait HasAlignment
{
    public string $alignment = 'left';

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

}
