<?php

namespace Tests\Feature\Components;

use Tests\TestCase;
use Tests\Fixtures\Models\Character;
use Tests\Fixtures\Components\CharactersTable;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TableTest extends TestCase
{
    use RefreshDatabase;

    public function testCanRenderPaginator(): void
    {
        Character::factory()->count(10)->create();

        Livewire::test(CharactersTable::class, ['enablePagination' => true, 'perPage' => 25])
            ->assertViewHas('models', Character::query()->paginate(25))
            ->set('perPage', 3)
            ->assertViewHas('models', Character::query()->paginate(3));
    }

    public function testCanRenderCollection(): void
    {
        Character::factory()->count(10)->create();

        Livewire::test(CharactersTable::class, ['enablePagination' => false])
            ->assertViewHas('models', Character::query()->get());
    }

    public function testCanRenderNoResults(): void
    {
        Livewire::test(CharactersTable::class)
            ->assertSee('No records was found.');
    }
}
