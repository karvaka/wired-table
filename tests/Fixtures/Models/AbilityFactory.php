<?php

namespace Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Factories\Factory;

class AbilityFactory extends Factory
{
    protected $model = Ability::class;

    public function definition(): array
    {
        return [
            'legend_id' => Legend::factory(),
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(Ability::types())
        ];
    }
}
