<?php

namespace Tests\Fixtures\Components;

use Illuminate\Database\Eloquent\Builder;
use Karvaka\Wired\Table\Columns\Column;
use Karvaka\Wired\Table\Components\Table;

class CharactersTable extends Table
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
