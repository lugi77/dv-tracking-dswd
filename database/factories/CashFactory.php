<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cash>
 */
class CashFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaction_no' => $this->faker->randomNumber(6, true),
            'dv_no' => $this->faker->unique()->regexify('[A-Z0-9]{6,20}'),
            'payment_type' => $this->faker->randomElement(['Check', 'ADA']),
            'check_ada_no' => $this->faker->regexify('[A-Z0-9]{6,20}'),
            'gross_amount' => $this->faker->randomFloat(2, 1000, 100000),
            'net_amount' => $this->faker->randomFloat(2, 900, 95000),
            'program' => $this->faker->word(),
            'date_received' => $this->faker->date(),
            'date_issued' => $this->faker->date(),
            'receipt_no' => $this->faker->regexify('[A-Z0-9]{6,20}'),
            'remarks' => $this->faker->sentence(10),
            'payee' => $this->faker->name(),
            'orsNum' => $this->faker->regexify('[A-Z0-9]{6,20}'),
            'particulars' => $this->faker->sentence(15),
            'appropriation' => $this->faker->randomElement(['Current', 'Continuing']),
            'outgoing_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Pending', 'Completed', 'Cancelled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
