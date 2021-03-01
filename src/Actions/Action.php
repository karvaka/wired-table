<?php

namespace Karvaka\Wired\Table\Actions;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Karvaka\Wired\Table\Concerns\AuthorizedToSee;
use Karvaka\Wired\Table\Concerns\HasComponent;
use Karvaka\Wired\Table\Utils;
use Karvaka\Wired\Table\Concerns\HasVisibility;

class Action
{
    use HasVisibility,
        HasComponent,
        AuthorizedToSee;

    protected ?string $name = null;
    protected ?string $label = null;
    protected bool $batch = false;
    protected bool $onlyBatch = false;
    protected bool $destructive = false;
    protected bool $confirmable = false;
    protected array $afterCallbacks = [];

    public function __construct()
    {

    }

    public static function make(): self
    {
        return new static();
    }

    public function name(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    // TODO change to unique key
    public function getName(): string
    {
        return $this->name ?? get_class($this);
    }

    public function label(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label ?? Utils::humanize($this);
    }

    public function batch(bool $batch): self
    {
        $this->batch = $batch;

        return $this;
    }

    public function isBatch(): bool
    {
        return $this->batch;
    }

    public function onlyBatch(): self
    {
        $this->batch = true;
        $this->onlyBatch = true;

        return $this;
    }

    public function isOnlyBatch(): bool
    {
        return $this->batch && $this->onlyBatch;
    }

    public function isInline(): bool
    {
        return ! $this->isOnlyBatch();
    }

    public function destructive(bool $destructive): self
    {
        $this->destructive = $destructive;

        return $this;
    }

    public function isDestructive(): bool
    {
        return $this->destructive;
    }

    public function confirmable(bool $confirmable): self
    {
        $this->confirmable = $confirmable;

        return $this;
    }

    public function isConfirmable(): bool
    {
        return $this->confirmable;
    }

    final public function execute(Model $model): void
    {
        $this->perform($model);

        foreach ($this->afterCallbacks as $callback) {
            $callback($model);
        }
    }

    final public function executeBatch(Collection $models): void
    {
        $this->performBatch($models);
    }

    public function perform(Model $model): void
    {
        //
    }

    public function canPerform(Model $model): bool
    {
        return true;
    }

    public function performBatch(Collection $models): void
    {
        foreach ($models as $model) {
            if (! $this->canPerform($model)) {
                continue;
            }

            $this->perform($model);
        }
    }

    public function canPerformBatch(string $modelClass): bool
    {
        return true;
    }

    public function after(callable $callback): self
    {
        $this->afterCallbacks[] = $callback;

        return $this;
    }
}
