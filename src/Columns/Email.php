<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;
use Karvaka\Wired\Table\Formatters\EmailFormatter;
use Karvaka\Wired\Table\Formatters\LinkFormatter;

class Email extends Link
{
    public function makeFormatter(Model $model): LinkFormatter
    {
        return new EmailFormatter($this, $model);
    }
}
