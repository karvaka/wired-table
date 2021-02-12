<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;

class Enum extends Column
{
    private array $values = [];

    public function values(array $values = []): self
    {
        $this->values = $values;

        return $this;
    }

    public function getValue(Model $model)
    {
        return $this->values[parent::getValue($model)] ?? null;
    }
}
