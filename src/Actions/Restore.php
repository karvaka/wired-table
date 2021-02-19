<?php

namespace Karvaka\Wired\Table\Actions;

use Illuminate\Database\Eloquent\Model;

class Restore extends Action
{
    public function handle(Model $model): void
    {
        $model->restore();
    }

    public function canHandle(Model $model): bool
    {
        return method_exists($model, 'trashed') ? $model->trashed() : false;
    }

    public function getIconComponent()
    {
        return 'heroicon-o-reply';
    }
}
