<?php

namespace Database\Factories;

use App\Models\Code;
use App\Models\Emirate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plate>
 */
class PlateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $number = $this->faker->numerify('#####');
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'emirate_id' => Emirate::inRandomOrder()->first()->id,
            'code_id' => Code::inRandomOrder()->first()->id,
            'number' => $number,
            'length' => strlen($number),
            'image' => null,
            'price' => $this->faker->randomFloat(2, 1000, 100000),
            'is_approved' => $this->faker->boolean(70),
            'is_sold' => $this->faker->boolean(20),
            'approved_at' => now(),
        ];

    }
}
