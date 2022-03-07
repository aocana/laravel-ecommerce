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
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->unique()->slug(),
            'stripe_id' => $this->faker->numberBetween(0, 999999),
            'file_path' => $this->faker->filePath(),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(0, 5000),
            'stock' => $this->faker->numberBetween(0, 5000),
            'sku' => $this->faker->numberBetween(0, 999999),
            'is_visible' => $this->faker->boolean(70),
        ];
    }
}
