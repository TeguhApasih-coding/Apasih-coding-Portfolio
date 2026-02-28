<?php

namespace Database\Factories;

use App\Models\SkillCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->word();
        $colors = ['#3B82F6', '#10B981', '#EF4444', '#F59E0B', '#8B5CF6', '#EC4899'];

        return [
            'name' => ucfirst($name),
            'slug' => \Illuminate\Support\Str::slug($name),
            'category_id' => SkillCategory::factory(),
            'icon' => null,
            'color' => fake()->randomElement($colors),
            'level' => fake()->numberBetween(1, 100),
            'display_order' => fake()->numberBetween(1, 50),
            'is_featured' => fake()->boolean(30),
            'is_active' => true,
            'description' => fake()->sentence(),
        ];
    }
}
