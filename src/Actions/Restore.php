<?php

namespace Karvaka\Wired\Table\Actions;

use Illuminate\Database\Eloquent\Model;

class Restore extends Action
{
    public string $inlineComponent = 'heroicon-o-reply';

    public function handle(Model $model): void
    {
        $model->restore();
    }

    public function canHandle(Model $model): bool
    {
        return method_exists($model, 'trashed') && $model->trashed();
    }
}
