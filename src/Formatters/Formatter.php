<?php

namespace Karvaka\Wired\Table\Formatters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Karvaka\Wired\Table\Columns\Column;

class Formatter
{
    private Column $column;
    private Model $model;

    public function __construct(Column $column, Model $model)
    {
        $this->column = $column;
        $this->model = $model;
    }

    public function getValue()
    {
        try {
            return data_get($this->model, $this->column->attribute);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
