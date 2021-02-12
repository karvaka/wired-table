<?php

namespace Karvaka\Wired\Table\Columns;

use Karvaka\Wired\Table\Utils;
use Illuminate\Database\Eloquent\Model;

class Column
{
    use Concerns\HasAlignment,
        Concerns\HasVisibility,
        Concerns\Searchable,
        Concerns\Sortable;

    public string $attribute;
    public string $label;
    public string $component = 'wired-table::columns.content';

    public function __construct(string $attribute, ?string $label = null)
    {
        $this->attribute = $attribute;
        $this->label = $label ?: Utils::humanize($attribute);
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

    public function renderCell(Model $model)
    {
        return view($this->component, [
            'model' => $model,
            'value' => $this->getValue($model)
        ]);
    }

    public function getValue(Model $model)
    {
        try {
            return data_get($model, $this->attribute);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
