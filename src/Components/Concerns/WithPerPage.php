<?php

namespace Karvaka\Wired\Table\Components\Concerns;

trait WithPerPage
{
    public bool $enablePerPage = true;
    public array $perPageOptions = [10, 25, 50];
    public int $perPage = 25;

    public function mountWithPerPage(): void
    {
        if ($this->enablePerPage) {
            $this->perPage = session()->get($this->perPageSessionKey(), $this->perPage);
        }
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();

        session()->put($this->perPageSessionKey(), $this->perPage);
    }

    private function perPageSessionKey(): string
    {
        return 'wired-table-per-page-' . get_class($this);
    }
}
