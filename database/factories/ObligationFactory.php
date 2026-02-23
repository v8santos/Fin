<?php

namespace Database\Factories;

use App\Enum\ObligationStatusEnum;
use App\Enum\ObligationTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Obligation>
 */
class ObligationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'expected_amount' => fake()->randomNumber(),
            'type' => fake()->randomElement(ObligationTypeEnum::class),
            'status' => fake()->randomElement(ObligationStatusEnum::class),
            'description' => fake()->text(),
            'due_date' => fake()->date(),
            'user_id' => User::factory(),
            'commitment_id' => null,
        ];
    }
}
