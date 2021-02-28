<?php

namespace Karvaka\Wired\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Karvaka\Wired\Table\Actions\Action;

trait WithActions
{
    public bool $enableBatchActions = false;
    public bool $enableInlineActions = true;
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
        return collect($this->actions());
    }

    public function batchActionBeingPerformed(): ?Action
    {
        return ! is_null($this->batchAction) ?
            $this->getActions()
                ->filter(fn (Action $action) => $action->isBatch())
                ->first(fn (Action $action) => $action->getName() === $this->batchAction) : null;
    }

    public function runBatchAction(): void
    {
        if (is_null($action = $this->batchActionBeingPerformed())) {
            return;
        }

        if ($action->isConfirmable()) {
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

        $action->executeBatch(
            $this->getQuery()->whereIn('id', $this->selectedModels)->get()
        );

        $this->unselectAll();
        $this->confirmingBatchAction = false;

        $this->emitSelf('batchActionPerformed', $action);
    }

    public function inlineActionBeingPerformed(): ?Action
    {
        return ! is_null($this->inlineAction) ?
            $this->getActions()
                ->filter(fn (Action $action) => $action->isInline())
                ->first(fn (Action $action) => $action->getName() === $this->inlineAction) : null;
    }

    public function runInlineAction($modelId, string $name): void
    {
        $this->inlineAction = $name;

        if (is_null($action = $this->inlineActionBeingPerformed())) {
            $this->inlineAction = null;
            return;
        }

        $this->inlineModelId = $modelId;

        if ($action->isConfirmable()) {
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

        $action->execute($model);

        $this->confirmingInlineAction = false;

        $this->emitSelf('actionPerformed', $action);
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
}
