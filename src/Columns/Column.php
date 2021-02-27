<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;
use Karvaka\Wired\Table\Utils;
use Karvaka\Wired\Table\Concerns\{
    HasComponent,
    HasVisibility,
    HasAttribute,
    HasLabel,
};

class Column
{
    use HasVisibility,
        HasComponent,
        HasAttribute,
        HasLabel,
        Concerns\HasAlignment,
        Concerns\Searchable,
        Concerns\Sortable;

    protected string $defaultComponent = 'wired-table::cells.content';

    public function __construct(string $attribute, ?string $label = null)
    {
        $this->attribute = $attribute;
        $this->label = $label ?? Utils::translate($attribute) ?? Utils::humanize($attribute);

        $this->init();
    }

    public static function make(string $attribute, ?string $label = null): self
    {
        return new static($attribute, $label);
    }

    protected function init(): void
    {
        //
    }

    public function renderCell(Model $model)
    {
        return view($this->getComponent(), [
            'model' => $model,
            'value' => $this->getValue($model)
        ]);
    }

    public function getValue(Model $model)
    {
        return rescue(function () use ($model) {
            return data_get($model, $this->attribute);
        }, null, false);
    }
}
