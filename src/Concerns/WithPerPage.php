<?php

namespace Karvaka\Wired\Table\Concerns;

trait WithPerPage
{
    public array $perPageOptions = [10, 25, 50];
    public int $perPage = 25;

    public function initializeWithPaginationPerPage(): void
    {
        $this->perPage = session()->get($this->perPageSessionKey(), $this->perPage);
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();

        session()->put($this->perPageSessionKey(), $this->perPage);
    }

    private function perPageSessionKey(): string
    {
        return 'wired-table.per-page.' . get_class($this);
    }
}
