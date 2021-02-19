<?php

namespace Karvaka\Wired\Table\Actions;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Karvaka\Wired\Table\Utils;
use Karvaka\Wired\Table\Concerns\HasVisibility;

abstract class Action
{
    use HasVisibility;

    protected bool $batch = true;
    protected bool $inline = true;
    protected bool $destructive = false;
    protected bool $confirmable = false;

    public function __construct()
    {

    }

    public static function make(): self
    {
        return new static();
    }

    public function perform(Collection $models): void
    {
        $models->each(function (Model $model) {
            if ($this->canHandle($model)) {
                $this->handle($model);
            }
        });
    }

    // TODO refactor
    // consider use only perform method
    abstract public function handle(Model $model): void;

    public function canHandle(Model $model): bool
    {
        return true;
    }

    public function getTitle(): string
    {
        return Utils::humanize($this);
    }

    public function getName(): string
    {
        return get_class($this);
    }

//    public function is(string $name): bool
//    {
//        return $name === $this->getName();
//    }

    public function isBatch(): bool
    {
        return $this->batch;
    }

    public function isInline(): bool
    {
        return $this->batch;
    }

    public function isDestructive(): bool
    {
        return $this->destructive;
    }

    public function isConfirmable(): bool
    {
        return $this->confirmable;
    }
}
