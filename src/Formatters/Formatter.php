<?php

namespace Karvaka\Wired\Table\Formatters;

use Illuminate\Database\Eloquent\Model;
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
        return $this->model->getAttribute($this->column->attribute);
    }

//    public function getValue()
//    {
//        $formatter = $this->column->formatter ?: function (Column $column, Model $model) {
//            return $model->getAttribute($column->attribute);
//        };
//
//        return app()->call($formatter, ['column' => $this->column, 'model' => $this->model]);
//    }
}
