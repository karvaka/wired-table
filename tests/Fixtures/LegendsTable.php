<?php

namespace Tests\Fixtures;

use Karvaka\Wired\Table\Column;
use Karvaka\Wired\Table\Table;

class LegendsTable extends Table
{
    public function columns(): array
    {
        return [
            Column::make('name'),
        ];
    }
}
