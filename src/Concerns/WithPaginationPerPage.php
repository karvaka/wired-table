<?php

namespace Karvaka\Wired\Table\Concerns;

trait WithPaginationPerPage
{
    public array $perPageOptions = [10, 25, 50];
    public int $perPage = 25;

    public function initializeWithPaginationPerPage(): void
    {
        $this->perPage = session()->get($this->sessionKey(), $this->perPage);
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();

        session()->put($this->sessionKey(), $this->perPage);
    }

    private function sessionKey(): string
    {
        return 'wired-table.per-page.' . get_class($this);
    }
}
