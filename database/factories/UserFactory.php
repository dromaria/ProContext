<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'age' => fake()->numberBetween(1,200),
        ];
    }

    public function withId(int $id): self
    {
        return $this->state([
            'id' => $id
        ]);
    }

}
