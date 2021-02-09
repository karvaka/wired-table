<?php

namespace Karvaka\Wired\Table\Columns;

use Karvaka\Wired\Table\Utils;
use Karvaka\Wired\Table\Formatters\Formatter;
use Illuminate\Database\Eloquent\Model;

class Column
{
    use Concerns\HasAlignment,
        Concerns\HasVisibility,
        Concerns\Searchable,
        Concerns\Sortable;

    public string $attribute;
    public string $label;
    public string $component = 'content';

    public function __construct(string $attribute, ?string $label = null)
    {
        $this->attribute = $attribute;
        $this->label = $label ?? Utils::humanize($attribute);
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

    public function makeFormatter(Model $model): Formatter
    {
        return new Formatter($this, $model);
    }
}
