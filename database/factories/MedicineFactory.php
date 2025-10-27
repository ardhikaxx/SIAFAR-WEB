<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'medicine_code' => $this->faker->unique()->numberBetween(1000, 9999),
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(100, 1000),
            'description' => $this->faker->paragraph(),
            'stock' => $this->faker->numberBetween(1, 100),
            'category_id' => $this->faker->numberBetween(1, 5),
            'unit_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
