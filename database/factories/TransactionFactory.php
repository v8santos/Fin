<?php

namespace Database\Factories;

use App\Enum\TransactionTypeEnum;
use App\Models\Obligation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
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
            'amount' => fake()->randomNumber(),
            'type' => fake()->randomElement(TransactionTypeEnum::class),
            'direction' => fake()->randomElement([-1,1]),
            'description' => fake()->text(),
            'obligation_id' => Obligation::factory(),
            'executed_at' => fake()->dateTime(),
        ];
    }
}
