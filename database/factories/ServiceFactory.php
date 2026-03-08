<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->words(2, true),
            'description' => fake()->sentence(12),
            'icon' => fake()->randomElement(['globe', 'app-window', 'smartphone', 'zap']),
            'order' => fake()->numberBetween(1, 20),
        ];
    }
}
