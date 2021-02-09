<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;

class Boolean extends Column
{
    public $trueValue = true;
    public $falseValue = false;

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

    public function formatValue(Model $model)
    {
        return (bool)$model->getAttribute($this->attribute) ? $this->trueValue : $this->falseValue;
    }
}
