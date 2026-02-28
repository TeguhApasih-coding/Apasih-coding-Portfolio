<?php

namespace Database\Factories;

use App\Models\User;
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
        $title = fake()->unique()->words(3, true);
        $technologies = ['Laravel', 'Vue.js', 'Tailwind CSS', 'MySQL', 'Redis', 'Docker', 'AWS'];

        return [
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'subtitle' => fake()->sentence(),
            'description' => fake()->paragraphs(5, true),
            'short_description' => fake()->paragraph(),
            'cover_image' => fake()->imageUrl(800, 600, 'technics'),
            'gallery_images' => [
                fake()->imageUrl(800, 600, 'technics'),
                fake()->imageUrl(800, 600, 'technics'),
                fake()->imageUrl(800, 600, 'technics'),
            ],
            'project_url' => fake()->url(),
            'github_url' => 'https://github.com/' . fake()->userName() . '/' . \Illuminate\Support\Str::slug($title),
            'technologies' => fake()->randomElements($technologies, fake()->numberBetween(3, 6)),
            'start_date' => fake()->dateTimeBetween('-2 years', '-6 months'),
            'end_date' => fake()->dateTimeBetween('-5 months', 'now'),
            'is_ongoing' => fake()->boolean(20),
            'is_featured' => fake()->boolean(30),
            'is_published' => true,
            'display_order' => fake()->numberBetween(1, 100),
            'client' => fake()->company(),
            'client_url' => fake()->url(),
            'user_id' => User::factory(),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
        ]);
    }

    public function ongoing(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_ongoing' => true,
            'end_date' => null,
        ]);
    }
}
