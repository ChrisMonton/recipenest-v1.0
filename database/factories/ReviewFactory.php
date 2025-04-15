<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1, // will be replaced by randomUsers
            'recipe_id' => 1, // will be replaced by randomProducts
            'title' => fake()->sentence(fake()->numberBetween(4, 6)),
            'review' => fake()->sentences(fake()->numberBetween(2, 8), true),
            'created_at' => fake()->dateTimeBetween(Carbon::now()->subDays(fake()->numberBetween(1, 20)), now()),
        ];
    }



    public function randomUsers($user_ids): Factory
    {
        return $this->state(function (array $attributes) use ($user_ids) {
            return [
                'user_id' => fake()->randomElement($user_ids),
            ];
        });
    }
}
