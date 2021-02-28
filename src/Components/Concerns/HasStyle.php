<?php

namespace Karvaka\Wired\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;

trait HasStyle
{
    public function rowAttributes(Model $model): ?array
    {
        return null;
    }

    public function getRowAttributes(Model $model): ?ComponentAttributeBag
    {
        if ($attributes = $this->rowAttributes($model)) {
            return new ComponentAttributeBag($attributes);
        }

        return null;
    }
}
