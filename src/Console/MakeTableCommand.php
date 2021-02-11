<?php

namespace Karvaka\Wired\Table\Console;

use Illuminate\Console\GeneratorCommand;

class MakeTableCommand extends GeneratorCommand
{
    protected $name = 'wired:table';
    protected $description = 'Create a new Wired table class';
    protected $type = 'Component';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\\Http\\Livewire';
    }

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/table.stub';
    }
}
