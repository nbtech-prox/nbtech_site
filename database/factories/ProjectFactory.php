<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [
            'title' => $title,
            'slug' => fake()->unique()->slug(),
            'description' => fake()->paragraph(),
            'technologies' => ['Laravel', 'TailwindCSS', 'AlpineJS'],
            'cover_image' => null,
            'gallery_images' => [],
            'project_url' => fake()->url(),
            'category' => fake()->randomElement(['Website', 'Web App', 'Plataforma Digital']),
            'featured' => fake()->boolean(30),
            'published' => true,
            'meta_title' => $title,
            'meta_description' => fake()->sentence(10),
        ];
    }
}
