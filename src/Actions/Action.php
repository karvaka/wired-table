<?php

namespace Karvaka\Wired\Table\Actions;

use BadMethodCallException;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Karvaka\Wired\Table\Concerns\HasComponent;
use Karvaka\Wired\Table\Utils;
use Karvaka\Wired\Table\Concerns\HasVisibility;

class Action
{
    use HasVisibility,
        HasComponent;

    protected ?string $name = null;
    protected ?string $title = null;
    protected bool $batch = false;
    protected bool $onlyBatch = false;
    protected bool $destructive = false;
    protected bool $confirmable = false;
    private $performUsing = null;
    private $canPerformUsing = null;

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

    public function getName(): string
    {
        return $this->name ?? get_class($this);
    }

    public function title(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title ?? Utils::humanize($this);
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

    public function performUsing(callable $callback): self
    {
        $this->performUsing = $callback;

        return $this;
    }

    public function perform(Model $model): void
    {
        if (is_callable($this->performUsing)) {
            app()->call($this->performUsing, ['model' => $model]);
            return;
        }

        throw new BadMethodCallException('Method [[Action::perform]] not implemented.');
    }

    public function canPerformUsing(callable $callback): self
    {
        $this->canPerformUsing = $callback;

        return $this;
    }

    public function canPerform(Model $model): bool
    {
        if (is_callable($this->canPerformUsing)) {
            return app()->call($this->canPerformUsing, ['model' => $model]);
        }

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
}
