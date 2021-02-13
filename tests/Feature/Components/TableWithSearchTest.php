<?php

namespace Tests\Feature\Components;

use Tests\TestCase;
use Tests\Fixtures\Models\Character;
use Tests\Fixtures\Components\CharactersTable;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TableWithSearchTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCanBeDisabled(): void
    {
        Character::factory()->count(10)->create();

        $component = Livewire::test(CharactersTable::class, ['enableSearch' => false])
            ->set('search', 'blahblah');

        $this->assertCount(10, $component->viewData('models'));
    }

    public function testCanSearch(): void
    {
        $faker = $this->faker;
        Character::factory()->count(10)->create(function () use ($faker) {
            return ['name' => 'Missing. ' . $faker->name];
        });
        Character::factory()->count(6)->create(function () use ($faker) {
            return ['name' => 'Found. ' . $faker->name];
        });

        $component = Livewire::test(CharactersTable::class);

        $this->assertCount(16, $component->viewData('models'));
        $component->set('search', 'Found.');
        $this->assertCount(6, $component->viewData('models'));
    }

    public function testCanSearchUsingCallback(): void
    {
        Character::factory()->count(8)->tank()->create();
        Character::factory()->count(4)->support()->create();

        $component = Livewire::test(CharactersTable::class);

        $this->assertCount(12, $component->viewData('models'));
        $component->set('search', Character::CLASS_SUPPORT);
        $this->assertCount(4, $component->viewData('models'));
    }
}
