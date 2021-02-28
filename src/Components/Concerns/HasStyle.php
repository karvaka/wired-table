<?php

namespace Karvaka\Wired\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;

trait HasStyle
{
    public function rowStyle(Model $model): string
    {
        return 'default';
    }

    public function getRowAttributes(string $style): ?ComponentAttributeBag
    {
        $attributes = new ComponentAttributeBag;

        switch ($style) {
            case 'info':
                $attributes->setAttributes(['class' => 'bg-blue-100']);
                break;
            case 'success':
                $attributes->setAttributes(['class' => 'bg-green-100']);
                break;
            case 'danger':
                $attributes->setAttributes(['class' => 'bg-red-100']);
                break;
            case 'warning':
                $attributes->setAttributes(['class' => 'bg-yellow-100']);
                break;
        }

        return $attributes;
    }
}
