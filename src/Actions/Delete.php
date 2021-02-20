<?php

namespace Karvaka\Wired\Table\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delete extends Action
{
    protected bool $batch = true;
    protected bool $destructive = true;
    protected bool $confirmable = true;
    protected string $defaultComponent = 'heroicon-o-trash';

    public function perform(Model $model): void
    {
        $model->delete();
    }

    public function canPerform(Model $model): bool
    {
        if (in_array(SoftDeletes::class, class_uses_recursive($model), true)) {
            return ! $model->trashed();
        }

        return true;
    }
}
