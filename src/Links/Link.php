<?php

namespace Karvaka\Wired\Table\Links;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Karvaka\Wired\Table\Concerns\AuthorizedToSee;
use Karvaka\Wired\Table\Concerns\HasComponent;
use Karvaka\Wired\Table\Concerns\HasVisibility;

class Link
{
    use HasComponent,
        HasVisibility,
        AuthorizedToSee;

    private ?Closure $to = null;
    private ?string $event = null;
    private bool $preventDefault = false;

    public function to(Closure $to)
    {
        $this->to = $to;

        return $this;
    }

    public function getLinkFor(Model $model)
    {
        if (is_null($this->to)) {
            return '#';
        }

        return call_user_func($this->to, $model);
    }

    public function emit(string $event)
    {
        $this->event = $event;

        return $this;
    }
    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function preventDefault()
    {
        $this->preventDefault = true;

        return $this;
    }

    public function isDefaultPrevented(): bool
    {
        return $this->preventDefault;
    }
}
