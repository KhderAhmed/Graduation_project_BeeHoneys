<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientRequest>
 */
class ClientRequestFactory extends Factory
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
            'client_id' =>1,
            'image' => $this->faker->image('public\blog', 50, 50),
        ];
    }
}
