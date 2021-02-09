<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;
use Karvaka\Wired\Table\Formatters\DateFormatter;
use Karvaka\Wired\Table\Formatters\Formatter;

class Date extends Column
{
    public string $format = 'Y-m-d';

    public function makeFormatter(Model $model): Formatter
    {
        return (new DateFormatter($this, $model))->format($this->format);
    }
}
