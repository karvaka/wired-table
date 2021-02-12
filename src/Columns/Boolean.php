<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;

class Boolean extends Column
{
    public $trueValue = 'Yes';
    public $falseValue = 'No';

    public function trueValue($value): self
    {
        $this->trueValue = $value;

        return $this;
    }

    public function falseValue($value): self
    {
        $this->falseValue = $value;

        return $this;
    }

    public function getValue(Model $model)
    {
        return (bool)parent::getValue($model) ? $this->trueValue : $this->falseValue;
    }
}
