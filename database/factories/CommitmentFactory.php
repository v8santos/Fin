<?php

namespace Database\Factories;

use App\Models\Obligation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commitment>
 */
class CommitmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'fixed_amount' => fake()->randomNumber(),
            'is_variable' => fake()->boolean(),
            'description' => fake()->text(),
            'is_active' => fake()->boolean(),
            'rrule' => 'FREQ=MONTHLY;COUNT=10;BYMONTHDAY=4',
            'start_date' => today(),
            'end_date' => now()->addMonths(10),
            'last_generated_at' => null,
        ];
    }
}
