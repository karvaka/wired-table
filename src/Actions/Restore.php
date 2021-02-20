<?php

namespace Karvaka\Wired\Table\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restore extends Action
{
    protected bool $batch = true;
    protected string $defaultComponent = 'heroicon-o-reply';

    public function perform(Model $model): void
    {
        $model->restore();
    }

    public function canPerform(Model $model): bool
    {
        if (in_array(SoftDeletes::class, class_uses_recursive($model), true)) {
            return $model->trashed();
        }

        return false;
    }

    public function canPerformBatch(string $modelClass): bool
    {
        return in_array(SoftDeletes::class, class_uses_recursive($modelClass), true);
    }
}
