<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $socialPlatforms = ['github', 'linkedin', 'twitter', 'instagram', 'dribbble', 'behance'];
        $selectedPlatforms = $this->faker->randomElements($socialPlatforms, rand(2, 4));
        
        $socialLinks = [];
        foreach ($selectedPlatforms as $platform) {
            $socialLinks[$platform] = 'https://' . $platform . '.com/in/' . $this->faker->userName();
        }

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => false,
            'avatar' => 'https://i.pravatar.cc/150?img=' . rand(1, 70),
            'phone' => $this->faker->phoneNumber(),
            'position' => $this->faker->jobTitle(),
            'bio' => $this->faker->paragraphs(2, true),
            'social_links' => json_encode($socialLinks),  // Convert to JSON string
            'website' => $this->faker->url(),
            'is_active' => true,
            'last_login_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'last_login_ip' => $this->faker->ipv4(),
            'last_login_user_agent' => $this->faker->userAgent(),
        ];
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => true,
            'email' => 'admin@example.com',
            'social_links' => json_encode([
                'github' => 'https://github.com/admin',
                'linkedin' => 'https://linkedin.com/in/admin',
                'twitter' => 'https://twitter.com/admin',
            ]),
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
