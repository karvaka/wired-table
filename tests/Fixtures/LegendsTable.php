<?php

namespace Tests\Fixtures;

use Illuminate\Database\Eloquent\Builder;
use Karvaka\Wired\Table\Columns\Column;
use Karvaka\Wired\Table\Table;

class LegendsTable extends Table
{
    public function columns(): array
    {
        return [
            Column::make('name')->searchable(),
            Column::make('occupation')->searchable(),
            Column::make('class')->searchUsing(function (Builder $query, string $criteria) {
                $query->where('class', '=', $criteria);
            }),
        ];
    }
}
