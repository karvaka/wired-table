<?php

namespace Karvaka\Wired\Table\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Model;

trait AuthorizedToSee
{
    private ?Closure $canSee = null;

    public function authorizedToSee(Model $model): bool
    {
        return $this->canSee ? call_user_func($this->canSee, $model) : true;
    }

    public function canSee(Closure $callback): self
    {
        $this->canSee = $callback;

        return $this;
    }
}
