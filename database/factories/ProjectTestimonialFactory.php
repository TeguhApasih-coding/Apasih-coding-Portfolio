<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectTestimonial>
 */
class ProjectTestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'client_name' => fake()->name(),
            'client_position' => fake()->jobTitle(),
            'client_company' => fake()->company(),
            'client_avatar' => fake()->imageUrl(128, 128, 'people'),
            'testimonial' => fake()->paragraphs(3, true),
            'rating' => fake()->numberBetween(4, 5),
            'is_featured' => fake()->boolean(40),
            'is_approved' => true,
            'display_order' => fake()->numberBetween(1, 20),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    public function unapproved(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_approved' => false,
        ]);
    }

}
