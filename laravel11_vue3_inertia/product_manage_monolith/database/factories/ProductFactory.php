<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'name' => $this->faker->sentence(1),
            'brand' => $this->faker->company(),
            'price' => $this->faker->randomDigitNot(0) * 100,
            'weight' => $this->faker->randomDigitNot(0),
            'description' => $this->faker->paragraph(3),
        ];
    }
}
