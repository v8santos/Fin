<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $amount = fake()->randomNumber(9, false),
            'label' => fake()->text(),
            'user_id' => User::factory(),
            'paid' => fake()->boolean(0.5),
            'amount_paid' => fake()->numberBetween(0, $amount),
        ];
    }
}
