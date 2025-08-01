<?php

namespace Database\Factories;

use App\Models\Shift;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barcode>
 */
class BarcodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Barcode ' . fake()->unique()->uuid(),
            'value' => fake()->ean13(),
            'radius' => 50,
            'latitude' => fake()->latitude(-90, 90),
            'longitude' => fake()->longitude(-90, 90),
        ];
    }
}
