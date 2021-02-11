<?php

namespace Karvaka\Wired\Table\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
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
            return collect($this->guessColumns());
        }

        return collect($this->columns());
    }

    public function guessColumns(): array
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

    public function applyColumns(Builder $query): void
    {
        $this->applyAggregateColumns($query);
    }

    private function applyAggregateColumns(Builder $query): void
    {
        // TODO 'max', 'min', 'sum', 'avg'
        // https://laravel.com/docs/8.x/eloquent-relationships#aggregating-related-models

        $aggregated = $this->getColumns()->filter(function (Column $column) {
            return Str::of($column->attribute)->endsWith('_count');
        });

        $relations = $aggregated->map(function (Column $column) {
            return (string)Str::of($column->attribute)->replaceLast('_count', '');
        })->toArray();

        if (count($relations)) {
            $query->withAggregate($relations, '*', 'count');
        }
    }
}
