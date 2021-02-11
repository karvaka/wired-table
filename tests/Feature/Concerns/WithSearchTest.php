<?php

namespace Tests\Feature\Concerns;

use Tests\TestCase;
use Tests\Fixtures\LegendsTable;
use Tests\Fixtures\Models\Legend;
use Tests\Seeders\LegendsSeeder;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WithSearchTest extends TestCase
{
    use RefreshDatabase;

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
