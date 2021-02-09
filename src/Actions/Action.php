<?php

namespace Karvaka\Wired\Table\Actions;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Karvaka\Wired\Table\Utils;

abstract class Action
{
    public bool $batch = true;
    public bool $inline = true;
    public bool $destructive = false;
    public bool $confirmable = false;

    public string $inlineComponent = 'wired-table.icons.pencil';

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
            $this->handle($model);
        });
    }

    public function handle(Model $model)
    {
        //
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
