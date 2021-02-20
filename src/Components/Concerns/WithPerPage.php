<?php

namespace Karvaka\Wired\Table\Components\Concerns;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

trait WithPerPage
{
    public bool $enablePerPage = true;
    public array $perPageOptions = [10, 25, 50];
    public int $perPage = 25;

    public function mountWithPerPage(): void
    {
        if ($this->enablePerPage) {
            $this->restorePerPage();
        }
    }

    public function updatedPerPage(): void
    {
        $this->storePerPage();

        $this->emitSelf('perPageChanged');
    }

    private function storePerPage(): void
    {
        if (Auth::check()) {
            Session::put($this->perPageSessionKey(), $this->perPage);
        }
    }

    private function restorePerPage(): void
    {
        $this->perPage = Auth::check() ?
            Session::get($this->perPageSessionKey(), $this->perPage) : $this->perPage;
    }

    private function perPageSessionKey(): string
    {
        return 'wired-table-per-page-' . Auth::id() . '-' . get_class($this);
    }
}
