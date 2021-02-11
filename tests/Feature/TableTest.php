<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Fixtures\Models\Legend;
use Tests\Fixtures\LegendsTable;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TableTest extends TestCase
{
    use RefreshDatabase;

    public function testRendersPaginator(): void
    {
        Legend::factory()->count(10)->create();

        $test = Livewire::test(LegendsTable::class, ['enablePagination' => true, 'perPage' => 25]);

        $test->assertViewHas('models', Legend::query()->paginate(25));

        $test->set('perPage', 3);

        $test->assertViewHas('models', Legend::query()->paginate(3));
    }

    public function testRendersCollection(): void
    {
        Legend::factory()->count(10)->create();

        $test = Livewire::test(LegendsTable::class, ['enablePagination' => false]);

        $test->assertViewHas('models', Legend::query()->get());
    }

    public function testRendersNoResults(): void
    {
        $test = Livewire::test(LegendsTable::class);

        $test->assertSee('No records was found.');
    }
}
