<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Writing>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['food', 'desert', 'drinks'];

        return [
            'category' => $types[fake()->numberBetween(0, 2)],
            'title' => fake()->realText(fake()->numberBetween(20, 40)),
            'short_description' => fake()->sentences(fake()->numberBetween(2, 3), true),
            'full_description' => fake()->paragraphs(fake()->numberBetween(5, 20), true),
            'ingredients' => $this->htmlData(fake()->numberBetween(2, 6)),
            'instructions' => $this->htmlData(fake()->numberBetween(2, 6)),
            // 'instructions' => fake()->sentences(fake()->numberBetween(2, 3), true),
            'image' => 'images/media/' . $this->randomImage(),
            'total_time' => fake()->numberBetween(1, 10),
            'total_time_unit' => 'minutes',
            'publish_date' => fake()->dateTimeBetween(now()->subMonth(3), now()->subMonth(1)),
        ];
    }


    public function randomImage()
    {
        $images = Storage::disk('media')->files();

        // Select a random index from the array
        $randomIndex = array_rand($images);

        // Retrieve the value corresponding to the random index
        $randomValue = $images[$randomIndex];

        return $randomValue;
    }

    public function htmlData($type = 'ol', $total = 6)
    {
        $html = '<ol>';
        for ($i = 0; $i < $total; $i++) {
            $html .= '<li>' . fake()->sentence(fake()->numberBetween(2, 6)) . '</>';
        }
        $html .= '</ol>';
        return $html;
    }

    public function featured(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'featured' => 1,
            ];
        });
    }
}
