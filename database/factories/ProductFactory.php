<?php

namespace Database\Factories;

use App\Models\Catgory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory>
 */
class ProductFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_ar' => $this->faker->word,
            'title_en' => $this->faker->word,
            'description_en' => $this->faker->sentence,
            'description_ar' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'catgory_id' =>1,
            'image' => $this->faker->image('public\blog', 50, 50),
        ];
    }
}
