<?php

namespace Tests\Feature\Components;

use Tests\TestCase;
use Tests\Fixtures\Components\CharactersTable;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TableWithColumnsTest extends TestCase
{
    use RefreshDatabase;

    public function testCanRenderColumns(): void
    {
        $component = Livewire::test(CharactersTable::class);

        $this->assertCount(3, $component->viewData('columns'));
    }
}
