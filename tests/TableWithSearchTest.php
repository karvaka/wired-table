<?php

namespace Tests;

use Livewire\Livewire;
use Tests\Fixtures\LegendsTable;
use Tests\Fixtures\Models\Legend;
use Tests\Seeders\LegendsSeeder;

class TableWithSearchTest extends TestCase
{
    public function testSearch(): void
    {
        $this->seed(LegendsSeeder::class);

        $test = Livewire::test(LegendsTable::class);

        $this->assertCount(16, $test->viewData('models'));

        $test->set('search', 'For');

        $this->assertCount(2, $test->viewData('models'));
    }

    public function testSearchUsing(): void
    {
        $this->seed(LegendsSeeder::class);

        $test = Livewire::test(LegendsTable::class);

        $this->assertCount(16, $test->viewData('models'));

        $test->set('search', Legend::CLASS_SUPPORT);

        $this->assertCount(2, $test->viewData('models'));
    }
}
