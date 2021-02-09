<?php

namespace Karvaka\Wired\Table\Actions;

use Illuminate\Database\Eloquent\Model;

class Delete extends Action
{
    public bool $destructive = true;
    public bool $confirmable = true;

    public string $inlineComponent = 'heroicon-o-trash';

    public function handle(Model $model)
    {
        $model->delete();
    }
}
