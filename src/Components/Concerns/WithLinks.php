<?php

namespace Karvaka\Wired\Table\Components\Concerns;

use Illuminate\Support\Collection;

trait WithLinks
{
    public function links(): array
    {
        return [];
    }

    public function getLinks(): Collection
    {
        return collect($this->links());
    }
}
