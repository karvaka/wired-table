<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;
use Karvaka\Wired\Table\Formatters\LinkFormatter;
use Karvaka\Wired\Table\Formatters\PhoneFormatter;

class Phone extends Link
{
    public function makeFormatter(Model $model): LinkFormatter
    {
        return new PhoneFormatter($this, $model);
    }
}
