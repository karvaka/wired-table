<?php

namespace Karvaka\Wired\Table\Concerns;

trait HasComponent
{
    protected ?string $component = null;

    public function component(string $component): self
    {
        $this->component = $component;

        return $this;
    }

    public function getComponent(): ?string
    {
        return $this->component ?? $this->getDefaultComponent();
    }

    protected function getDefaultComponent()
    {
        if (method_exists($this, 'defaultComponent')) return $this->defaultComponent();
        if (property_exists($this, 'defaultComponent')) return $this->defaultComponent;

        return null;
    }
}
