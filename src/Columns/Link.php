<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;
use Karvaka\Wired\Table\Formatters\LinkFormatter;

class Link extends Column
{
    public string $component = 'link';

    public function makeFormatter(Model $model): LinkFormatter
    {
        return new LinkFormatter($this, $model);
    }
}
