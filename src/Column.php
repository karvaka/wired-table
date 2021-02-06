<?php

namespace Karvaka\Wired\Table;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Column
{
    public string $attribute;
    public string $label;
    public string $component = 'content';
    public $formatter;
    public string $alignment = 'left';
    public bool $searchable = false;
    public $searchUsing = null;

    public function __construct(string $attribute, ?string $label = null)
    {
        $this->attribute = $attribute;
        $this->label = $label ?? $this->convertAttributeToLabel($attribute);
    }

    public static function make(string $attribute, ?string $label = null): self
    {
        return new static($attribute, $label);
    }

    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function component(string $component): self
    {
        $this->component = $component;

        return $this;
    }

    public function asRaw(): self
    {
        return $this->component('raw');
    }

//    public function asBoolean(): self
//    {
//        $this->formatter = function (Column $column, Model $model) {
//            return (bool) $model->getAttribute($column->attribute);
//        };
//
//        return $this->component('boolean');
//    }
//
//    public function asNumber(): self
//    {
//        $this->alignment = 'right';
//        $this->formatter = function () {
//            // TODO
////            return number_format();
//        };
//
//        return $this;
//    }

    public function asEmail(): self
    {
        return $this->component('email');
    }

    public function asPhone(): self
    {
        return $this->component('phone');
    }

    public function asImage(): self
    {
        return $this->component('image');
    }

//    public function asLink(): self
//    {
//
//    }

    public function formatValue(Model $model)
    {
        $formatter = $this->formatter ?: function (Column $column, Model $model) {
            return $model->getAttribute($column->attribute);
        };

        return app()->call($formatter, ['column' => $this, 'model' => $model]);
    }

    public function alignLeft(): self
    {
        $this->alignment = 'left';

        return $this;
    }

    public function alignRight(): self
    {
        $this->alignment = 'right';

        return $this;
    }

    public function alignCenter(): self
    {
        $this->alignment = 'center';

        return $this;
    }

    public function searchable(): self
    {
        $this->searchable = true;

        return $this;
    }

    public function searchUsing(callable $callable): self
    {
        $this->searchable = true;
        $this->searchUsing = $callable;

        return $this;
    }

    private function convertAttributeToLabel(string $attribute): string
    {
        return Str::of($attribute)->replace(['_', '-', '.'], ' ')->ucfirst();
    }
}
