<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;

class Date extends Column
{
    public string $format = 'Y-m-d';

    public function getValue(Model $model)
    {
        $value = parent::getValue($model);

        return $value instanceof \DateTimeInterface ? $value->format($this->format) : null;
    }
}
