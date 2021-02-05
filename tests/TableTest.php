<?php

namespace Tests;

use Tests\Fixtures\Models\Legend;
use Tests\Fixtures\UnknownTable;
use Tests\Fixtures\LegendsTable;
use Livewire\Livewire;
use Illuminate\Database\Eloquent\Builder;
use Tests\Seeders\LegendsSeeder;

class TableTest extends TestCase
{
    public function testQueryDiscovered(): void
    {
        $table = new LegendsTable;

        $this->assertInstanceOf(Builder::class, $table->query());
    }

    public function testThrowsExceptionIfQueryNotDiscovered(): void
    {
        $this->expectException(\BadMethodCallException::class);

        (new UnknownTable)->query();
    }

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

        $test->assertSee('No results.');
    }

    public function testSearch(): void
    {
        $this->seed(LegendsSeeder::class);

        $test = Livewire::test(LegendsTable::class);

        $this->assertCount(16, $test->viewData('models'));

        $test->set('search', 'For');

        $this->assertCount(2, $test->viewData('models'));
    }
}
