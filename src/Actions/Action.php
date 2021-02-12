<?php

namespace Karvaka\Wired\Table\Actions;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Karvaka\Wired\Table\Columns\Concerns\HasVisibility;
use Karvaka\Wired\Table\Utils;

abstract class Action
{
    use HasVisibility;

    public bool $batch = true;
    public bool $inline = true;
    public bool $destructive = false;
    public bool $confirmable = false;

    public string $inlineComponent = 'heroicon-o-pencil';

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

    public function is(string $name): bool
    {
        return $name === $this->getName();
    }
}
