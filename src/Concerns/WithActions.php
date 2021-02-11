<?php

namespace Karvaka\Wired\Table\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Karvaka\Wired\Table\Actions\Action;
use Karvaka\Wired\Table\Actions\Delete;
use Karvaka\Wired\Table\Actions\Restore;

trait WithActions
{
    public bool $enableActions = true;
    public array $selectedModels = [];
    public ?string $batchAction = null;
    public bool $confirmingBatchAction = false;
    public ?string $inlineAction = null;
    public ?string $inlineModelId = null;
    public bool $confirmingInlineAction = false;

    public function actions(): array
    {
        return [];
    }

    public function getActions(): Collection
    {
        $actions =  collect($this->actions());

        $actions = $actions->merge($this->defaultActions());

        return $actions;
    }

    public function batchActionBeingPerformed(): ?Action
    {
        return ! is_null($this->batchAction) ?
            $this->getActions()
                ->where('batch', '=', true)
                ->first(fn (Action $action) => $action->is($this->batchAction)) : null;
    }

    public function runBatchAction(): void
    {
        if (is_null($action = $this->batchActionBeingPerformed())) {
            return;
        }

        if ($action->confirmable) {
            $this->confirmingBatchAction = true;
            return;
        }

        $this->performBatchAction();
    }

    public function performBatchAction(): void
    {
        if (is_null($action = $this->batchActionBeingPerformed())) {
            return;
        }

        $action->perform(
            $this->query()->whereIn('id', $this->selectedModels)->get()
        );

        $this->unselectAll();
        $this->confirmingBatchAction = false;

        $this->emit('actionPerformed', $action->getName());
    }

    public function inlineActionBeingPerformed(): ?Action
    {
        return ! is_null($this->inlineAction) ?
            $this->getActions()
                ->where('inline', '=', true)
                ->first(fn (Action $action) => $action->is($this->inlineAction)) : null;
    }

    public function runInlineAction($modelId, string $name): void
    {
        $this->inlineAction = $name;

        if (is_null($action = $this->inlineActionBeingPerformed())) {
            $this->inlineAction = null;
            return;
        }

        $this->inlineModelId = $modelId;

        if ($action->confirmable) {
            $this->confirmingInlineAction = true;
            return;
        }

        $this->performInlineAction();
    }

    public function performInlineAction(): void
    {
        $model = $this->findModel($this->inlineModelId);
        $action = $this->inlineActionBeingPerformed();

        if (is_null($model) || is_null($action)) {
            $this->inlineModelId = null;
            $this->inlineAction = null;
            return;
        }

        $action->perform(collect([$model]));

        $this->confirmingInlineAction = false;

        $this->emit('actionPerformed', $action->getName());
    }

    public function selectAll(): void
    {
        $this->selectedModels = $this->getAllModelsKeys();
    }

    public function unselectAll(): void
    {
        $this->selectedModels = [];
    }

    public function toggleSelectAll(): void
    {
        $this->isSelectedAll() ? $this->unselectAll() : $this->selectAll();
    }

    public function isSelectedAll(): bool
    {
        return collect($this->getAllModelsKeys())->diff($this->selectedModels)->isEmpty();
    }

    private function getAllModelsKeys(): array
    {
        return $this->getModels()->map(function (Model $model) {
            return (string)$model->getRouteKey();
        })->toArray();
    }

    private function defaultActions(): array
    {
        return [
            Delete::make(),
            Restore::make()
        ];
    }
}
