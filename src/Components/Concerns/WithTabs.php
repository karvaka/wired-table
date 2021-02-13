<?php

namespace Karvaka\Wired\Table\Components\Concerns;

use Karvaka\Wired\Table\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait WithTabs
{
    public bool $enableTabs = true;
    public ?string $tab = null;

    public function initializeWithTabs(): void
    {
        if ($this->enableTabs) {
            $default = ! is_null($this->getDefaultTab()) ? $this->getDefaultTab()->attribute : null;

            $this->queryString = array_merge($this->queryString, ['tab' => ['except' => $default]]);

            $this->tab = $this->resolveTab($default);
        }
    }

    public function tabs(): array
    {
        return [];
    }

    public function getTabs(): Collection
    {
        return collect($this->tabs());
    }

    public function getDefaultTab(): ?Tab
    {
        return $this->getTabs()->first();
    }

    public function gotoTab(?string $tab): void
    {
        $this->tab = $tab;

        // TODO exec in class using events
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }

        if (method_exists($this, 'resetFilters')) {
            $this->resetFilters();
        }
    }

    public function isTabActive($tab): bool
    {
        return $tab->attribute === $this->tab;
    }

    public function resolveTab($default = null)
    {
        return request()->query('tab', $this->tab ?: $default);
    }

    public function applyTabs(Builder $query): void
    {
        if (! $this->enableTabs) {
            return;
        }

        $tab = $this->getTabs()->first(fn (Tab $tab) => $tab->attribute === $this->tab);
        if (! $tab) {
            return;
        }

        if (is_callable($tab->filterUsing)) {
            app()->call($tab->filterUsing, ['query' => $query]);
        }
    }
}
