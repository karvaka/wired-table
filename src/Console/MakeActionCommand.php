<?php

namespace Karvaka\Wired\Table\Console;

use Illuminate\Console\GeneratorCommand;

class MakeActionCommand extends GeneratorCommand
{
    protected $name = 'wired:action';
    protected $description = 'Create a new Wired action class';
    protected $type = 'Action';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\\Http\\Wired\\Actions';
    }

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/action.stub';
    }
}
