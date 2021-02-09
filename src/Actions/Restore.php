<?php

namespace Karvaka\Wired\Table\Actions;

use Illuminate\Database\Eloquent\Model;

class Restore extends Action
{
    public function handle(Model $model)
    {
        $model->restore();
    }
}
