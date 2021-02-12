<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;

class Phone extends Link
{
    public function getLink(Model $model)
    {
        return 'tel:' . parent::getLink($model);
    }
}
