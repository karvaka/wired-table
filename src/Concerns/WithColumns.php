<?php

namespace Karvaka\Wired\Table\Concerns;

use Illuminate\Support\Collection;
use Karvaka\Wired\Table\Columns\Column;
use Karvaka\Wired\Table\Columns\Date;
use Karvaka\Wired\Table\Columns\DateTime;
use Karvaka\Wired\Table\Columns\Number;

trait WithColumns
{
    public function columns(): array
    {
        return [];
    }

    final private function getColumns(): Collection
    {
        if (! count($this->columns())) {
            return collect($this->defaultColumns());
        }

        return collect($this->columns());
    }

    public function defaultColumns(): array
    {
        if (is_null($model = $this->query()->first())) {
            return [];
        }

        return collect($model->toArray())
            ->keys()
            ->map(function ($attribute) use ($model) {
                switch ($attribute) {
                    case $model->hasCast($attribute, ['int', 'integer', 'real', 'float', 'double', 'decimal']):
                        return Number::make($attribute);
                    case $model->hasCast($attribute, 'date'):
                        return Date::make($attribute);
                    case $model->hasCast($attribute, ['datetime', 'custom_datetime', 'timestamp']):
                        // TODO doesn't work with default timestamps
                        return DateTime::make($attribute);
                    default:
                        return Column::make($attribute);
                }
            })->toArray();
    }
}
