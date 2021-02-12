<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;

class Email extends Link
{
    public function getLink(Model $model)
    {
        return 'mailto:' . parent::getLink($model);
    }
}
