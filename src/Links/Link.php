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

    private ?Closure $to;

    public function to(Closure $to)
    {
        $this->to = $to;

        return $this;
    }

    public function getLinkFor(Model $model)
    {
        if (is_null($this->to)) {
            throw new \BadMethodCallException;
        }

        return call_user_func($this->to, $model);
    }
}
