<?php

namespace Tests;

use Tests\Fixtures\Models\Legend;
use Tests\Fixtures\UnknownTable;
use Tests\Fixtures\LegendsTable;
use Livewire\Livewire;
use Illuminate\Database\Eloquent\Builder;

class TableTest extends TestCase
{
    public function testQueryDiscovered(): void
    {
        $table = new LegendsTable;

        $this->assertInstanceOf(Builder::class, $table->query());
    }

    public function testQueryNotDiscovered(): void
    {
        $this->expectException(\BadMethodCallException::class);

        (new UnknownTable())->query();
    }

    public function testRendersModels(): void
    {
        Legend::factory()->count(10)->create();

        $response = Livewire::test(LegendsTable::class);

        $response->assertViewHas('models', Legend::query()->get());
    }

    public function testRendersNoResults(): void
    {
        $test = Livewire::test(LegendsTable::class);

        $test->assertSee('No results.');

    }
}
