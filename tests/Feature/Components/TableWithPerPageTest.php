<?php

namespace Tests\Feature\Components;

use Illuminate\Contracts\Auth\Authenticatable;
use Mockery;
use Tests\TestCase;
use Tests\Fixtures\Models\User;
use Tests\Fixtures\Models\Character;
use Tests\Fixtures\Components\CharactersTable;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TableWithPerPageTest extends TestCase
{
    use RefreshDatabase;

    public function testCanBeDisabled(): void
    {
        $component = Livewire::test(CharactersTable::class, ['enablePerPage' => false, 'perPage' => 1]);
        // assert fallbacks to model per page
        $this->assertEquals(
            Character::query()->getModel()->getPerPage(), $component->viewData('models')->perPage()
        );
    }

    public function testCanChangePaginationPerPage(): void
    {
        $component = Livewire::test(CharactersTable::class, ['perPage' => 25]);
        $this->assertEquals(25, $component->viewData('models')->perPage());
        $component->set('perPage', 5);
        $this->assertEquals(5, $component->viewData('models')->perPage());
    }

    public function testAuthenticatedCanStoreValueInSession(): void
    {
        $this->authenticate();

        $this->actingAs($user = Mockery::mock(Authenticatable::class));
        $user->shouldReceive('getAuthIdentifier')->andReturn(1);
        $user->shouldReceive('getKey')->andReturn(1);

        $key = 'wired-table-per-page-' . CharactersTable::class;

        $component = Livewire::test(CharactersTable::class, ['perPage' => 25]);
        $component->lastResponse->assertSessionMissing($key);
        $component->set('perPage', 10);
        $component->lastResponse->assertSessionHas($key, 10);
    }

    public function testAuthenticatedCanRestoreValueFromSession(): void
    {
        $this->authenticate();

        $key = 'wired-table-per-page-' . $this->authenticatedAs->getAuthIdentifier() . '-' . CharactersTable::class;

        $this->withSession([
            $key => 10
        ]);

        Livewire::test(CharactersTable::class, ['perPage' => 25])
            ->assertSet('perPage', 10);
    }
}
