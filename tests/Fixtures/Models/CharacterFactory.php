<?php

namespace Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    protected $model = Character::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'occupation' => $this->faker->jobTitle,
            'class' => $this->faker->randomElement(Character::classes())
        ];
    }

    public function tank(): self
    {
        return $this->state(['class' => Character::CLASS_TANK]);
    }

    public function damage(): self
    {
        return $this->state(['class' => Character::CLASS_DAMAGE]);
    }

    public function support(): self
    {
        return $this->state(['class' => Character::CLASS_SUPPORT]);
    }

    public function withEachAbilityType(): self
    {
//        return $this->has();
    }
}
