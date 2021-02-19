<?php

namespace Karvaka\Wired\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Karvaka\Wired\Table\Tabs\Tab;

trait WithTabs
{
    public bool $enableTabs = true;
    public ?string $tab = null;

    public function initializeWithTabs(): void
    {
        if ($this->enableTabs) {
            $default = ! is_null($this->getDefaultTab()) ? $this->getDefaultTab()->getAttribute() : null;

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

        $this->emitSelf('tabSwitched', $tab);
    }

    public function isTabActive(Tab $tab): bool
    {
        return $tab->getAttribute() === $this->tab;
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

        $tab = $this->getTabs()->first(fn (Tab $tab) => $tab->getAttribute() === $this->tab);
        if (! $tab) {
            return;
        }

        if (is_callable($callback = $tab->getFilterCallback())) {
            app()->call($callback, ['query' => $query]);
        }
    }
}
