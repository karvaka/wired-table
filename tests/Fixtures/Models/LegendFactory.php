<?php

namespace Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Factories\Factory;

class LegendFactory extends Factory
{
    protected $model = Legend::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'class' => $this->faker->randomElement(Legend::classes())
        ];
    }
}