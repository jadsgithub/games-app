<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teams>
 */
class TeamsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'conference' => fake()->name(),
            'division' => fake()->name(),
            'city' => fake()->city(),
            'name' => fake()->firstName(),
            'full_name' => fake()->name(),
            'abbreviation' => Str::take(fake()->name(), 3),
        ];
    }
}
